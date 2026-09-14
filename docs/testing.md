---
type: Guide
title: "Testing"
description: "PHPUnit setup, the testing database, safety rules around RefreshDatabase, and where test coverage is missing."
tags: [testing, phpunit]
status: stable
stale_after: 2027-03-13
---

# Testing

Sail commands assume `APP_SERVICE=digi-space-app` in `.env` (see [local setup](local-setup.md)).

Framework: **PHPUnit 11** (`phpunit/phpunit ^11`, `brianium/paratest` available). This project does **not** use Pest — write classic `class FooTest extends TestCase` tests with `test_*` methods or `#[Test]` attributes, matching `tests/Feature/Auth/*`.

## Running

```bash
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit                              # whole suite
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit --testsuite=Unit             # fast, no DB
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit --filter=AuthenticationTest  # one class
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit tests/Feature/Auth/AuthenticationTest.php

```

## The testing database — read before running Feature tests

`phpunit.xml` sets:

```xml
<env name="APP_ENV" value="testing"/>
<env name="DB_DATABASE" value="testing"/>
<env name="CACHE_DRIVER" value="array"/>
<env name="SESSION_DRIVER" value="array"/>
<env name="MAIL_MAILER" value="array"/>
<env name="QUEUE_CONNECTION" value="sync"/>
```

Only `DB_DATABASE` is overridden — **connection, host, user and password come from `.env`**. All Breeze feature tests use `RefreshDatabase`, which runs `migrate:fresh` on the resolved database. Consequences:

1. The `testing` database must exist on a dedicated local MySQL server reachable through the resolved connection. Sail creates it on first initialization of a new MySQL volume via `create-testing-database.sh`; on any other setup create it by hand.
2. If `bootstrap/cache/config.php` exists (someone ran `config:cache`), the `phpunit.xml` env overrides are **ignored** and tests run against the cached `DB_DATABASE` — i.e. your dev data gets dropped. Run `php artisan config:clear` before the suite whenever in doubt.
3. There is no guard in `tests/TestCase.php` that refuses to run against a non-`testing` database. The XML entries have no `force=true`, so pre-existing process variables can also win. Verify the resolved environment, connection, host and database before running tests. A database-name check is:
   ```bash
   APP_ENV=testing DB_DATABASE=testing php artisan config:show database
   ```
   before the first run on a new machine (inspect locally; output can include credentials). Do not run feature tests against an unverified connection. Parallel testing is not a documented baseline until isolated worker databases and setup have been verified.
4. `BlogRepository` and a few queries use MySQL-specific SQL (`YEAR()`, `MONTHNAME()`, backticks). Do not switch the test connection to SQLite expecting the whole suite to pass.

Never run the test suite with `DB_DATABASE` pointing at `global_digi_space` or any production name.

## What exists

| Test | Covers |
|---|---|
| `tests/Feature/Auth/*` | Breeze login, password reset/confirm, email verification, registration (routes are disabled but `RegistrationTest` still expects success; it is not marked skipped) |
| `tests/Feature/ExampleTest.php`, `UserTest.php`, `tests/Unit/ExampleTest.php` | Scaffold placeholders |

No tests cover widgets, pages, menus, blog, services/products, contact form, Zoho, sitemap or any admin CRUD.

## Where to start when adding tests

- **Public pages** need seeded widget categories with the ids from `config/constants.php`; create only the rows and relationships needed by the page, with explicit IDs. The historical image-category migration shifts automatic IDs on a fresh database; blindly invoking the existing seeders does not resolve this. Only `UserFactory` exists.
- **Admin CRUD** — `actingAs(User::factory()->create(['email_verified_at' => now()]))`, post to the named route (`route('admin.post-store')`), assert redirect + `assertDatabaseHas`. Inertia responses can be asserted with `assertInertia(fn ($page) => $page->component('Admin/Posts/Index')->has('posts'))` (`inertiajs/inertia-laravel` ships the testing helpers).
- **Contact form** — fake the outbound calls: `Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => true])])` for `RecaptchaRule`; the Zoho SDK is not HTTP-client based, so wrap `ContactController::sentLeadToZoho` behind a class you can bind a fake for before testing that path.
- **Uploads** — `Storage::fake('s3')` for widgets/posts; service images and banners write to `public/uploads` / `public/banners` via `move()`, so either assert against a temp `public_path` or refactor to `Storage::disk('public')` first.
- **Sitemap** — `GenerateSitemap` crawls `APP_URL` over HTTP; use an isolated HTTP fixture server or an injectable crawler boundary; Laravel `Http::fake()` does not intercept Spatie’s crawler.

## Static analysis

`vendor/bin/phpstan analyse` — Larastan level 5 over `app/`. `_ide_helper_models.php` (generated, git-ignored) helps PhpStorm but is not needed by PHPStan. Qodana config (`qodana.yaml`, PHP 8.1 profile) exists but is not wired into CI.
