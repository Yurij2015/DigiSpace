---
name: phpunit-testing
description: "Write or run DigiSpace PHPUnit 10 tests with explicit database isolation and fakes for this Laravel application."
---

# DigiSpace PHPUnit testing

Read [testing](../../../docs/testing.md) before running database-backed tests.

## Framework and commands

Use the existing PHPUnit classes and `test_*` methods (or supported PHPUnit attributes). This repository has PHPUnit 10, not Pest. Do not use VetSpace's Pest, PostgreSQL, tenancy or browser-test configuration.

Sail requires `APP_SERVICE=digi-space-app` in `.env`. After checking the environment, run the smallest relevant target:

```bash
vendor/bin/sail artisan test tests/Feature/Auth/AuthenticationTest.php
vendor/bin/sail artisan test --filter=AuthenticationTest
```

Pure unit tests that extend `PHPUnit\Framework\TestCase` can run through `vendor/bin/phpunit --testsuite=Unit` on a compatible host PHP. Confirm the chosen tests do not bootstrap the application before assuming no DB access.

## Before RefreshDatabase

`tests/TestCase.php` has no database safety guard. `phpunit.xml` supplies `DB_DATABASE=testing` without forcing it and leaves connection/host inherited. Cached Laravel configuration or existing process environment can override assumptions. Verify resolved environment, connection, host and database locally; do not print credentials in reports. Avoid feature tests until the target is known to be disposable. Do not run `migrate:fresh` on development or production data.

MySQL-specific queries prevent treating SQLite as a drop-in replacement. Parallel execution additionally needs verified worker database isolation; it is not the default documented setup.

## Fixtures and network isolation

- Build the rows required by the behavior. Public pages rely on fixed category IDs and menu/page links. Existing seeders are not a safe complete fixture: a historical migration shifts category IDs, and `UserSeeder` deletes users.
- `Http::fake()` handles reCAPTCHA's Laravel client; it does not intercept Zoho SDK requests or the Spatie sitemap crawler. Use an injectable boundary or isolated fixture server for those paths.
- `Storage::fake('s3')` covers widget/post uploads. Service/banner direct `move()` calls need a temporary public path or a separately scoped storage refactor.
- Assert actual response, persistence and authorization behavior. Registration routes are disabled while scaffold tests still expect success; report that mismatch rather than enabling registration to satisfy tests.

Do not claim test coverage from source inspection or a build. Report exactly what ran, its outcome, and any setup limitation.
