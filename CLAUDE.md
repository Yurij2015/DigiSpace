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
# Fresh installs: use LocalDevelopmentSeeder instead (fixes category-ID drift, adds site chrome) — local app only, guarded against populated DBs
vendor/bin/sail artisan db:seed --class=LocalDevelopmentSeeder

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

**Magic IDs live in `config/constants.php`** (`FOOTER_CATEGORY = 11`, `CHOOSE_US_WIDGET_CATEGORY = 12`, `PAGE_SUBMENU_FIRST = 2`, `PAGES_IMAGES = 16`, …) and `ContactController::GET_IN_TOUCH = 15`. They are primary keys of seeded rows, so the seeders and production DB must agree with them. Never renumber; if you add a category, add a constant and a seeder row together. `WidgetCategorySeeder` accepts `fixedIds: true` (used by `LocalDevelopmentSeeder`) to assign explicit IDs 1–15 that match the constants; plain `DatabaseSeeder` relies on auto-increment and can drift.

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

`push` to `dev` deploys the **testing** environment, `push` to `master` deploys **production** (`workflow_dispatch` can target `testing` / `production` / `all`). `.github/workflows/deploy.yml`: build on CI (composer `--no-dev`, `npm run build`, tarball) → PHPUnit suite on a MySQL 8 service (gates every deploy) → per server from the `DEPLOYMENT_MATRIX` GitHub Variable (filtered by branch through `.github/actions/export-deploy-matrix`): upload over SSH → extract into `releases/<sha>` → write `.env` from the environment's GitHub Variables/Secrets (`compose-env.sh`; previous file kept as `.env_prev`) → back up image dirs → symlink `storage`/`.env` and switch `current` → restore images → `after-deploy.sh` (`migrate --force`, `livewire:publish --assets`, `config:cache`, `view:cache`) → health check of `APP_URL` and `/control/login` → prune to five releases. Details in [`docs/deployment/README.md`](docs/deployment/README.md), GitHub setup in [`docs/deployment/github-setup-commands.md`](docs/deployment/github-setup-commands.md).

No server address, user, path or `.env` value is committed: `deployment-config.json` is git-ignored (only `example.deployment-config.json` with placeholders is tracked) and `.env` is git-ignored. Treat both as sensitive — never paste their contents into issues, PRs or chat.

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

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application running on PHP 8.3. You are an expert with the Laravel ecosystem. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `vendor/bin/sail npm run build`, `vendor/bin/sail npm run dev`, or `vendor/bin/sail composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists (settled decisions, non-obvious traps, standing constraints). Framework and package guidelines that only apply to specific paths (testing, frontend, components) also live there, under `.ai/rules/boost` — this is not just recorded decisions, it is load-bearing guidance you have not seen inline. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.
- Record a rule with `record-rule` only when the user explicitly asks for one. Instructions for the work at hand are not rules, no matter how emphatic: "remove this typo", "use X here" are work to do, not rules to record. Never record a rule on your own initiative, as a byproduct of a change, or to summarize what you just did. When the user does ask, pass a `glob` (e.g. `app/Http/Controllers/**`), a short `title`, and a few-line `note`. Use `record-rule` rather than your native memory or notes tool, because native memory is personal and session-scoped, while only `.ai/rules` is shared with the team and persists in the repo.

## Artisan

- Run Artisan commands directly via the command line (e.g., `vendor/bin/sail artisan route:list`). Use `vendor/bin/sail artisan list` to discover available commands and `vendor/bin/sail artisan [command] --help` to check parameters.
- Inspect routes with `vendor/bin/sail artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `vendor/bin/sail artisan config:show app.name`, `vendor/bin/sail artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `vendor/bin/sail artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `vendor/bin/sail artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.
- Activate the `deploying-to-cloud` skill whenever deploying to Laravel Cloud, configuring Cloud environments or resources, using the Cloud CLI, or troubleshooting Cloud deployments.

=== sail rules ===

# Laravel Sail

- This project runs inside Laravel Sail's Docker containers. You MUST execute all commands through Sail.
- Start services using `vendor/bin/sail up -d` and stop them with `vendor/bin/sail stop`.
- Open the application in the browser by running `vendor/bin/sail open`.
- Always prefix PHP, Artisan, Composer, and Node commands with `vendor/bin/sail`. Examples:
    - Run Artisan Commands: `vendor/bin/sail artisan migrate`
    - Install Composer packages: `vendor/bin/sail composer install`
    - Execute Node commands: `vendor/bin/sail npm run dev`
    - Execute PHP scripts: `vendor/bin/sail php [script]`
- View all available Sail commands by running `vendor/bin/sail` without arguments.

=== inertia-laravel/core rules ===

# Inertia

- Inertia creates fully client-side rendered SPAs without modern SPA complexity, leveraging existing server-side patterns.
- Components live in `resources/js/Pages` (unless specified in `vite.config.js`). Use `Inertia::render()` for server-side routing instead of Blade views.
- ALWAYS use `search-docs` tool for version-specific Inertia documentation and updated code examples.
- IMPORTANT: Activate `inertia-vue-development` when working with Inertia Vue client-side patterns.

# Inertia v2

- Use all Inertia features from v1 and v2. Check the documentation before making changes to ensure the correct approach.
- New features: deferred props, infinite scroll, merging props, polling, prefetching, once props, flash data.
- When using deferred props, add an empty state with a pulsing or animated skeleton.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `vendor/bin/sail artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `vendor/bin/sail artisan list` and check their parameters with `vendor/bin/sail artisan [command] --help`.
- If you're creating a generic PHP class, use `vendor/bin/sail artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `vendor/bin/sail artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `vendor/bin/sail artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `vendor/bin/sail npm run build` or ask the user to run `vendor/bin/sail npm run dev` or `vendor/bin/sail composer run dev`.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/sail bin pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/sail bin pint --test --format agent`, simply run `vendor/bin/sail bin pint --format agent` to fix any formatting issues.

=== phpunit/core rules ===

# PHPUnit

- This project uses PHPUnit. Create tests with `vendor/bin/sail artisan make:test --phpunit {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `vendor/bin/sail artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/sail bin phpunit` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

=== inertia-vue/core rules ===

# Inertia + Vue

Vue components must have a single root element.
- IMPORTANT: Activate `inertia-vue-development` when working with Inertia Vue client-side patterns.

</laravel-boost-guidelines>
