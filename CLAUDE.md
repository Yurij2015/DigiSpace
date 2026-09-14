# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Local stack (Laravel Sail, PHP 8.3 runtime + MySQL 8) — app on http://localhost:8100 when APP_PORT=8100
vendor/bin/sail up -d
vendor/bin/sail down

# Frontend (Vite: Inertia/Vue admin + Tailwind)
npm run dev          # HMR
npm run build        # production assets → public/build

# Tests (PHPUnit 10, NOT Pest) — see "Testing" below before running anything with RefreshDatabase
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit --filter=AuthenticationTest
vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit tests/Feature/Auth/AuthenticationTest.php

# Static analysis (Larastan level 5, app/ only) and code style
vendor/bin/phpstan analyse
vendor/bin/pint --dirty

# Migrations / seed — read docs/local-setup.md first; full seed deletes users and has ID drift
vendor/bin/sail artisan migrate
vendor/bin/sail artisan db:seed          # DatabaseSeeder → widget categories, widgets, pages, menus, products, services, posts, users

# SEO sitemap (also scheduled daily in app/Console/Kernel.php)
vendor/bin/sail artisan sitemap:generate

# IDE helpers (files are git-ignored)
vendor/bin/sail artisan ide-helper:models -N
```

If Sail is not running, the same commands work on host PHP (`php artisan …`) as long as `DB_HOST` in `.env` points at a reachable MySQL — `.env` is git-ignored; use the Compose service `digi-space-db` inside Docker. Set `APP_SERVICE=digi-space-app` for Sail commands and `APP_PORT=8100` for the documented URL (Compose defaults to 80).

## What this project is

Company website + blog + service catalogue for **digispace.pro**, with a self-written admin panel. Laravel 13 on PHP ^8.3, MySQL 8. One repository, one app, two rendering stacks:

| Surface | Stack | Where |
|---|---|---|
| Public site (`/`, `/about`, `/services`, `/blog`, `/contact-us`, `/pages/{slug}`, …) | **Blade** + server-rendered components, jQuery/Bootstrap theme from `public/css|js` | `resources/views/`, `app/View/Components/`, public controllers in `app/Http/Controllers/` |
| Admin panel (`/admin/*`, `/portfolio/*`, `/dashboard`) | **Inertia.js + Vue 3** (Breeze scaffold, Tailwind, TinyMCE) | `resources/js/Pages/Admin/**`, `app/Http/Controllers/Admin/**` |
| Tiny JSON API (`/api/education`, `/api/user`) | Sanctum | `routes/api.php`, `app/Http/Controllers/Api/` |

Do not mix the two: public pages return `view(...)`, admin pages return `Inertia::render(...)`. Both share the `web` middleware group — `HandleInertiaRequests` is registered there and is harmless for Blade responses.

## Architecture

### Content model (CMS-lite)

The public site combines static templates with database-backed content; read [`docs/content-model.md`](docs/content-model.md) before touching public pages.

- **`widget_categories` → `widgets`** — a widget is a block of HTML (`content`, TinyMCE), plus `title`, `subtitle`, `widget_image`, optional `widget_icons`. The category decides *where on the site* the widget shows up.
- **`pages`** — a page row (`slug`, `name`, `meta`, `description`, `content`) linked to widgets through the `page_widget` pivot (`Page::widgets()`).
- **`menus` → `menu_items`** — navigation; `menu_items.slug` is what `/pages/{slug}` resolves (`PageController::show` goes *MenuItem → pages*, not `Page::where('slug')`).
- **`settings`**, `header_nav_bar_contents`, `footer_bottom_bar_contents`, `footer_useful_links` — singleton-ish site chrome edited from admin.

**Magic IDs live in `config/constants.php`** (`FOOTER_CATEGORY = 11`, `CHOOSE_US_WIDGET_CATEGORY = 12`, `PAGE_SUBMENU_FIRST = 2`, `PAGES_IMAGES = 16`, …) and `ContactController::GET_IN_TOUCH = 15`. They are primary keys of seeded rows, so the seeders and production DB must agree with them. Never renumber; if you add a category, add a constant and a seeder row together.

`ContentServiceProvider::boot()` runs on **every request** and `View::share()`s footer widgets, sub-menus, latest posts, header/footer bar content and service categories to all Blade views (wrapped in a swallow-all `try/catch` so `artisan` works on an empty DB). Anything global to the layout goes there; do not re-query it in controllers.

### Public site conventions

- Controllers are thin, delegate to `app/Services/*` (`ServicesService`, `AboutService`, `PostService`, `WidgetService`, `PagesService`, `DefaultPageService`) and `app/Repositories/BlogRepository`.
- `PostService` / `WidgetService::changeImgPathIfNull()` only replace legacy placeholder URLs. Widget accessors supply a fallback for empty values; post accessors do not. See `docs/content-model.md` before changing image normalization.
- SEO/OG tags are in `resources/views/layouts/main.blade.php` and depend on `$post`, `$page` + `$pageImage`, `$serviceCategory` being passed with those exact names.
- `Service` uses `slug` as route key (`getRouteKeyName`), `Post` and `Category` have a `slug` column too; blog URLs are `/blog/{postSlug}`, `/blog-category/{categorySlug}`, `/blog-archive/{yearMonth}`.
- `config('settings.is_promo_tab_active')` (`IS_PROMO_TAB_ACTIVE`) toggles the Promos tab.
- `BlogRepository` uses MySQL-only SQL (`YEAR()`, `MONTHNAME()`, backtick quoting). Tests that hit it need MySQL, not SQLite.

### Admin conventions

- Routes are **not** resourceful. Pattern per entity in `routes/web.php`: `Route::controller(X::class)->middleware('auth')->group(...)` with explicit verbs and names `admin.<entity>-<action>` (`admin.post-store`, `admin.widget-update-form`, …). Follow the naming of the sibling group, even when it is inconsistent (`admin.dafault-pages` is a real, referenced typo — do not "fix" it without updating every `route()` call in Vue).
- Portfolio (`/portfolio/*`, `app/Http/Controllers/Admin/Portfolio/`, `app/Models/Portfolio/Pf*`) is a separate multi-locale CV module (education, skills, sections) with its own `*Locale` tables; it is only exposed publicly through `GET /api/education`.
- Validation goes in `app/Http/Requests/*SaveRequest.php`; contact form uses `RecaptchaRule` and `propaganistas/laravel-phone`.
- Vue pages are resolved by path: `Inertia::render('Admin/Posts/Update')` ⇒ `resources/js/Pages/Admin/Posts/Update.vue`. Ziggy is available (`route('admin.posts')` in Vue). Flash messages arrive as `$page.props.flash.message` (`HandleInertiaRequests::share`).
- TinyMCE needs `api_key_tinymce` prop passed from the controller (`config('app.tiny_mce_api_key')`).
- Registration routes are commented out in `routes/auth.php` — admins are created by `UserSeeder`/manually. Login is `/login`, `/admin` and `/admin/profile` declare `verified`, but `User` does not implement `MustVerifyEmail`; verification is not currently enforced by that middleware.

### File uploads — two different targets

| What | Where it goes | How |
|---|---|---|
| Widget images, post images | **S3/MinIO** (`Storage::disk('s3')`, bucket `MINIO_BUCKET`, endpoint `MINIO_ENDPOINT`), full URL stored in DB | `WidgetController::storeWidgetImageOnMinio`, `PostController` |
| Service images | `public/uploads/` (filename in DB, `Service::image` accessor prefixes `/uploads/`) | `$request->file->move(public_path('uploads'))` |
| Blog banners | `public/banners/` | `BlogPostBannerController` |

`public/uploads` and `public/images` are git-ignored; `public/banners` is not explicitly ignored. All three are **copied across deployments by the GitHub workflow** (backed up before release, restored after). Anything else written into `public/` at runtime is lost on the next deploy.

### Integrations (all configured in `config/services.php` / `.env`)

- **Zoho CRM** — every contact form submission is stored in `contact_forms` *and* pushed as a Lead (`ContactController::sentLeadToZoho`, SDK `zohocrm/php-sdk-8.0`, US data centre). The SDK writes `../zohoStore.txt` and `../php_sdk_log.log` relative to `public/` (i.e. project root); the token store must be writable. Structured API errors are logged, but uncaught SDK exceptions can fail the response after the database insert. Empty credentials do not disable Zoho.
- **Google reCAPTCHA** — `RecaptchaRule` on the contact form (`RECAPTCHA_SITE_KEY` / `RECAPTCHA_SECRET_KEY`).
- **Sentry** — `sentry/sentry-laravel`, DSN via `SENTRY_LARAVEL_DSN`.
- **TinyMCE** (`TINY_MCE_API_KEY`), **Facebook Pixel** (`FACEBOOK_PIXEL_ID`, inlined in `layouts/main.blade.php`).
- **Sitemap** — `spatie/laravel-sitemap` crawls `APP_URL` daily → `public/sitemap.xml`.

The example/default queue is `sync` and cache is `file`; Compose provides no Redis/Horizon worker. Live runtime configuration was not verified.

## Testing

PHPUnit 11 (`phpunit.xml`), `tests/Unit` and `tests/Feature`. Sail commands require `APP_SERVICE=digi-space-app`. Breeze auth tests use `RefreshDatabase`, which **migrates fresh on whatever DB the test process resolves**. `phpunit.xml` sets `DB_DATABASE=testing` but keeps `DB_HOST`/connection from `.env`, and there is no `.env.testing` committed. Sail's MySQL creates the `testing` database on first initialization of a new volume (`create-testing-database.sh`); on any other host, create it first and double-check the resolved connection, host and database locally under explicit test environment variables before running the suite. Never point tests at the production/dev database name.

There is no `RefreshDatabase` safety guard in `tests/TestCase.php` (unlike the VetSpace API) — the only protection is the `testing` DB name from `phpunit.xml`. Do not run tests with a stale `bootstrap/cache/config.php`; run `php artisan config:clear` first if `config:cache` was ever used locally.

Coverage of the domain (widgets/pages/blog/admin) is essentially zero; the existing tests are the Breeze scaffold. When adding tests for public pages, create the required category IDs explicitly. The historical image-category migration shifts automatic IDs before seeders run; see `docs/local-setup.md`. `UserSeeder` deletes existing users, so full seeding is unsuitable for populated databases.

## Deployment

`push` to `master` triggers `.github/workflows/deploy.yml`: build on CI (composer `--no-dev`, `npm run build`, tarball), then for each server in `deployment-config.json` (matrix; see `example.deployment-config.json` — test + prod on CloudPanel, PHP 8.3 CLI path hard-coded in `afterHooks`): upload → extract into `releases/<sha>` → backup `.env` + image dirs → write `.env` from the `LARAVEL_ENV` secret and immediately restore the previous one (so the server's `.env` wins) → symlink `storage` and `current` → restore images → `artisan migrate` → prune old releases. Details in [`docs/deployment/README.md`](docs/deployment/README.md).

`deployment-config.json` (real server IPs/users/paths) **is committed**; `.env` is git-ignored. Treat both as sensitive — never paste their contents into issues, PRs or chat.

## Documentation layout

- [`docs/README.md`](docs/README.md) — index
- [`docs/project-analysis.md`](docs/project-analysis.md) — verified findings and review scope
- [`docs/architecture.md`](docs/architecture.md) — request flow, layers, folders
- [`docs/content-model.md`](docs/content-model.md) — widgets/pages/menus and the magic IDs
- [`docs/local-setup.md`](docs/local-setup.md) — Sail, env, seeding
- [`docs/testing.md`](docs/testing.md) — PHPUnit, testing DB, what to cover
- [`docs/deployment/README.md`](docs/deployment/README.md) — GitHub Actions → CloudPanel flow, rollback
- [`docs/integrations.md`](docs/integrations.md) — Zoho, reCAPTCHA, MinIO, Sentry, TinyMCE, Pixel

Project skills live in `.claude/skills/` — activate the relevant one when working in that area:
`digispace-cms-content`, `inertia-admin-crud`, `phpunit-testing`, `laravel-best-practices`.

Only create new documentation files when explicitly asked.
