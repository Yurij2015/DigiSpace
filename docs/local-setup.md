---
type: Guide
title: "Local Setup"
description: "Running DigiSpace locally with Laravel Sail (or host PHP), required environment variables, seeding and frontend build."
tags: [setup, sail, docker, env]
status: stable
stale_after: 2027-03-13
---

# Local Setup

## Requirements

- Docker (for Sail) **or** host PHP ≥ 8.3 with `pdo_mysql`, `mbstring`, `fileinfo`, `gd`/`exif` + a MySQL 8 server
- Node 20.19+ / npm (required by Laravel Boost; also supports the Vite build)
- Composer 2

## 1. Environment

```bash
cp .env.example .env  # only on first setup; preserve an existing .env
```

Keys that matter (everything else in `.env.example` is Laravel boilerplate):

| Key | Purpose | Local value |
|---|---|---|
| `APP_URL` | Used by sitemap crawler, OG tags, image fallback URLs | `http://localhost:8100` |
| `APP_PORT` | Host port Sail publishes (Compose defaults to 80) | `8100` |
| `APP_SERVICE` | Required by Sail commands for the custom Compose service | `digi-space-app` |
| `DB_HOST` / `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` | MySQL | `digi-space-db` (Sail service; container name is `digi-spase-db`) / `global_digi_space` |
| `FORWARD_DB_PORT` | Host port for MySQL (optional) | `3306` |
| `TINY_MCE_API_KEY` | Rich-text editor in admin (widgets, posts, pages, services) | required for admin editing |
| `RECAPTCHA_SITE_KEY` / `RECAPTCHA_SECRET_KEY` | Contact form | required to submit `/contact-us`; fake verification in automated tests |
| `ZOHO_CLIENT_ID` / `ZOHO_CLIENT_SECRET` / `ZOHO_GRANT_TOKEN` | Lead push on contact form | no disable switch; missing credentials can throw after the DB insert |
| `AWS_*`, `MINIO_ENDPOINT`, `MINIO_BUCKET`, `AWS_URL` | `s3` disk for widget/post images | configure an external/local S3-compatible service; a saved URL does not prove upload success |
| `SENTRY_LARAVEL_DSN` | Error tracking | empty locally |
| `IS_PROMO_TAB_ACTIVE` | Shows the Promos tab | `false` |
| `FACEBOOK_PIXEL_ID` | Inline pixel in layout | empty locally |
| `FILAMENT_ADMIN_EMAILS` | Comma-separated emails allowed into `/control` outside `local` | empty locally (all local authenticated users are allowed) |

`QUEUE_CONNECTION=sync`, `CACHE_DRIVER=file`, `SESSION_DRIVER=file` are the example/default configuration. Compose does not include Redis; live production configuration was not verified.

## 2. Start the stack

```bash
composer install
vendor/bin/sail up -d
vendor/bin/sail artisan key:generate
vendor/bin/sail artisan migrate
# Review the seed caveat below before populating data.
```

`../compose.yml` defines two services: `digi-space-app` (Sail PHP **8.3** runtime, container `global-digi-space`) and `digi-space-db` (MySQL 8, container `digi-spase-db`, volume `digispace-mysql`). On first initialization of a new volume, the MySQL init script also creates an empty `testing` database used by PHPUnit.

Without Sail: set `DB_HOST=127.0.0.1`, create the `global_digi_space` and `testing` databases, then `php artisan migrate` and `php artisan serve`; review seed caveats first.

## 3. Frontend

```bash
npm install
npm run dev      # Vite dev server on :5173 with HMR (admin bundle + Tailwind)
npm run build    # production build → public/build (git-ignored; CI builds it for deploys)
```

The public site's theme CSS/JS is static in `public/css|js|fonts` and is **not** processed by Vite. Vite handles `resources/js/app.js` (Inertia admin) and `resources/css/*.css`.

If the admin renders without styles or with "Unable to locate file in Vite manifest", run `npm run build` or keep `npm run dev` running.

## 4. Seed data and logging in

Seed rows live in **`database/seeders/data/*.json`** — one file per table, each row with an `i18n` block holding `en`, `uk` and `pl` values side by side (edit the JSON to change wording or translations; `tests/Unit/SeedDataTest.php` fails if a locale is missing). The seeder classes (`WidgetSeeder`, `MenuItemSeeder`, …) are thin `JsonTableSeeder`s that insert those rows **with their recorded IDs**, so `config/constants.php` and the pivot seeders (`page_widget`, `product_service`, `widget_icons`) stay consistent. They are for empty tables only.

`DatabaseSeeder` calls: widget categories → widgets → widget icons → users → pages → page_widget → menus → menu items → products → services → product_service → categories → posts. Header/footer chrome seeders are only called by `LocalDevelopmentSeeder`. `UserSeeder` deletes existing users; never rerun a full seed on a populated database.

For a clean local database run the guarded fixture:

```bash
vendor/bin/sail artisan migrate
vendor/bin/sail artisan db:seed --class=LocalDevelopmentSeeder
```

`LocalDevelopmentSeeder` runs only when `APP_ENV=local`, refuses populated tables or non-fresh ID sequences, relocates the migration-created image category (`2023_06_11_214433`) to `PAGES_IMAGES` (16), seeds widget categories 1–15, adds the site-chrome fixtures, publishes all posts and prints a generated local password for the seeded admin. After it, `/uk` and `/pl` render fully translated menus, headings and footer.

**Adding translations to an existing database** (local dev DB, testing, production) — additive and repeatable, base columns untouched, editor-made translations preserved:

```bash
vendor/bin/sail artisan db:seed --class=StructureTranslationsSeeder
```

Admin users come from `database/seeders/UserSeeder.php` (emails `admin*@globaldigispace.com`; passwords are set in the seeder). Registration is disabled in `routes/auth.php`. Routes `/admin` and `/admin/profile` declare `verified`, but `User` does not implement `MustVerifyEmail`, so that middleware does not enforce verification for the current model. Sail does not start the Mailhog service named in `.env.example`; use `MAIL_MAILER=log` locally for password-reset mail.

## 5. Useful commands

```bash
vendor/bin/sail artisan sitemap:generate       # crawls APP_URL → public/sitemap.xml
vendor/bin/sail artisan ide-helper:models -N   # refresh _ide_helper_models.php (git-ignored)
vendor/bin/phpstan analyse                     # Larastan level 5 over app/
vendor/bin/pint --dirty                        # format changed PHP files
vendor/bin/sail artisan route:list --path=admin
```

## 6. Laravel Boost

Boost is a development dependency and provides project-specific AI guidelines, skills and an MCP server. After `composer install`, refresh its generated guidance with:

```bash
vendor/bin/sail artisan boost:update
vendor/bin/sail artisan boost:list-skills
```

The MCP server is configured in `.mcp.json` and runs through Sail. Do not install Boost into the production dependency set.

## Troubleshooting

- **Public pages render without footer/menu** — `ContentServiceProvider` swallowed a DB exception; check the connection or missing seeded rows (`config/constants.php` ids).
- **`/pages/{slug}` 404** — pages are resolved through `menu_items.slug`, not `pages.slug` (see [content-model.md](./content-model.md)).
- **Contact form always fails validation** — reCAPTCHA keys missing or the site key in the Blade form does not match `RECAPTCHA_SITE_KEY`.
- **`zohoStore.txt` / `php_sdk_log.log` permission errors** — the Zoho SDK writes these relative to `public/` (project root); verify the resolved path and narrowly grant write access to the intended files. Empty `ZOHO_*` values do not disable initialization.
- **Tests wiped my dev data** — see [testing.md](./testing.md); `RefreshDatabase` migrates fresh on `DB_DATABASE=testing`, but only if config is not cached.
