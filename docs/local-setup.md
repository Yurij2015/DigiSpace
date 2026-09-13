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

- Docker (for Sail) **or** host PHP ≥ 8.2 with `pdo_mysql`, `mbstring`, `fileinfo`, `gd`/`exif` + a MySQL 8 server
- Node 18+ / npm
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

`QUEUE_CONNECTION=sync`, `CACHE_DRIVER=file`, `SESSION_DRIVER=file` are the example/default configuration. Compose does not include Redis; live production configuration was not verified.

## 2. Start the stack

```bash
composer install
vendor/bin/sail up -d
vendor/bin/sail artisan key:generate
vendor/bin/sail artisan migrate
# Review the seed caveat below before populating data.
```

`docker-compose.yml` defines two services: `digi-space-app` (Sail PHP **8.3** runtime, container `global-digi-space`) and `digi-space-db` (MySQL 8, container `digi-spase-db`, volume `digispace-mysql`). On first initialization of a new volume, the MySQL init script also creates an empty `testing` database used by PHPUnit.

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

`DatabaseSeeder` seeds, in order: widget categories → widgets → widget icons → users → pages → page_widget → menus → menu items → products → services → product_service → categories → posts. This is historical seed data, not a verified complete fresh-install fixture. The migration `2023_06_11_214433_add_row_to_widget_categories_table.php` inserts the image category before seeders run. On an empty database it takes ID 1; `WidgetCategorySeeder` then inserts 15 categories without explicit IDs, shifting them to 2–16 while widget foreign keys/constants expect 1–15. Header/footer content seeders exist but are not called by `DatabaseSeeder`. `UserSeeder` deletes existing users; do not rerun the full seed on a populated database.

For a clean local database, run the guarded fixture instead:

```bash
vendor/bin/sail artisan migrate
vendor/bin/sail artisan db:seed --class=LocalDevelopmentSeeder
```

`LocalDevelopmentSeeder` runs only when `APP_ENV=local`, refuses populated tables or non-fresh ID sequences, relocates the migration-created image category to ID 16, seeds widget categories with fixed IDs, adds the omitted site-chrome fixtures, publishes all posts, and prints a generated local password for the seeded admin. It is intentionally not called by `DatabaseSeeder` and must never be used against an existing database.

Admin users come from `database/seeders/UserSeeder.php` (emails `admin*@globaldigispace.com`; passwords are set in the seeder). Registration is disabled in `routes/auth.php`. Routes `/admin` and `/admin/profile` declare `verified`, but `User` does not implement `MustVerifyEmail`, so that middleware does not enforce verification for the current model. Sail does not start the Mailhog service named in `.env.example`; use `MAIL_MAILER=log` locally for password-reset mail.

## 5. Useful commands

```bash
vendor/bin/sail artisan sitemap:generate       # crawls APP_URL → public/sitemap.xml
vendor/bin/sail artisan ide-helper:models -N   # refresh _ide_helper_models.php (git-ignored)
vendor/bin/phpstan analyse                     # Larastan level 5 over app/
vendor/bin/pint --dirty                        # format changed PHP files
vendor/bin/sail artisan route:list --path=admin
```

## Troubleshooting

- **Public pages render without footer/menu** — `ContentServiceProvider` swallowed a DB exception; check the connection or missing seeded rows (`config/constants.php` ids).
- **`/pages/{slug}` 404** — pages are resolved through `menu_items.slug`, not `pages.slug` (see [content-model.md](./content-model.md)).
- **Contact form always fails validation** — reCAPTCHA keys missing or the site key in the Blade form does not match `RECAPTCHA_SITE_KEY`.
- **`zohoStore.txt` / `php_sdk_log.log` permission errors** — the Zoho SDK writes these relative to `public/` (project root); verify the resolved path and narrowly grant write access to the intended files. Empty `ZOHO_*` values do not disable initialization.
- **Tests wiped my dev data** — see [testing.md](./testing.md); `RefreshDatabase` migrates fresh on `DB_DATABASE=testing`, but only if config is not cached.
