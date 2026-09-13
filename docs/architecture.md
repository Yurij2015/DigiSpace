---
type: Guide
title: "Architecture"
description: "Request flow, rendering stacks, layers and folder responsibilities of the DigiSpace Laravel application."
tags: [architecture, laravel, inertia, blade]
status: stable
stale_after: 2027-03-13
---

# Architecture

Single Laravel 11 application (`laravel/framework` v11.46, PHP ^8.2, MySQL 8). The example/default configuration uses a synchronous queue and file cache/session. Compose has no Redis or queue worker; live configuration was not verified.

## Two rendering stacks in one app

```
                 ┌──────────────── web middleware group ────────────────┐
Request ───────► │ EncryptCookies → Session → CSRF → SubstituteBindings │
                 │ → HandleInertiaRequests                              │
                 └───────────────┬──────────────────────┬───────────────┘
                                 │                      │
                     public routes                 auth routes (/admin/*, /portfolio/*, /dashboard)
                                 │                      │
                     Controller → Service/Repo      Admin\Controller → Eloquent
                                 │                      │
                     view('home.index', …)          Inertia::render('Admin/Posts/Index', …)
                                 │                      │
                     Blade + View Components        resources/js/Pages/Admin/**/*.vue
                     (+ View::share from            (Vue 3, Tailwind, Ziggy routes,
                      ContentServiceProvider)        TinyMCE, flash via $page.props.flash)
```

### Public site (Blade)

- Entry: `routes/web.php` top section (`home.index`, `about`, `services`, `pricing`, `promos`, blog, contact, `pages.page`, service category pages, footer pages).
- Controllers in `app/Http/Controllers/*Controller.php` are thin; they resolve widget categories through `app/Services/*` and pass collections to views.
- `resources/views/layouts/main.blade.php` is the single layout (title/OG/meta blocks keyed on `$post`, `$page`+`$pageImage`, `$serviceCategory`; Facebook Pixel inline; theme CSS/JS from `public/css`, `public/js`).
- Reusable blocks are **Blade class components** (`app/View/Components/*.php` + `resources/views/components/*.blade.php`): header, footer, footer useful links, latest news, "choose us", FAQ, our projects, technologies, pricing, contact form, Google map.
- Global layout data (footer widgets, sub-menus, latest posts, header/footer bars, service categories) is pushed into every view by `App\Providers\ContentServiceProvider::boot()` via `View::share()`. It runs on every request including artisan; the `try/catch` around it exists so the app boots without a database.

### Admin panel (Inertia + Vue 3)

- Scaffolded from Laravel Breeze (Inertia/Vue), kept on the legacy `@inertiajs/inertia-vue3` 0.6 packages (not `@inertiajs/vue3`). `resources/js/app.js` mounts the app; pages are resolved from `resources/js/Pages/**` by the string passed to `Inertia::render()`.
- Shared props (`app/Http/Middleware/HandleInertiaRequests.php`): `auth.user`, `ziggy` (named routes + current URL), `flash.message`.
- Layouts: `resources/js/Layouts/AuthenticatedLayout.vue` (admin shell, sidebar in `resources/js/Components/Sidebar`), `GuestLayout.vue` (auth screens).
- Each admin area = one controller in `app/Http/Controllers/Admin/` + a `Route::controller()->middleware('auth')->group()` in `routes/web.php` + a folder in `resources/js/Pages/Admin/<Area>/` (`Index.vue`, `Create.vue`, `Update.vue`, optional `Components/`).
- Auth: Breeze session auth (`routes/auth.php`, `app/Http/Controllers/Auth/`). Registration is disabled; `/admin` and `/admin/profile` declare `verified`, but `User` does not implement `MustVerifyEmail`, so verification is not enforced by that middleware for the current model.
- Portfolio module (`Admin/Portfolio/*`, `app/Models/Portfolio/Pf*`) is a multi-locale CV data set with its own migrations (`2024_01_29_*`, `2024_02_*`) and a single public JSON endpoint `GET /api/education`.

### API

`routes/api.php` — `throttle:api`; Sanctum authentication applies only to `/api/user`. Only `GET /api/user` (sanctum) and `GET /api/education` (public). There is no JSON API for the CMS content.

## Layers and folders

| Layer | Location | Notes |
|---|---|---|
| Routing | `routes/web.php`, `routes/auth.php`, `routes/api.php` | All web routes in one file, grouped per controller |
| HTTP | `app/Http/Controllers`, `app/Http/Requests`, `app/Http/Middleware` | FormRequests named `*SaveRequest`; `RecaptchaRule` in `app/Rules` |
| Domain helpers | `app/Services`, `app/Repositories/BlogRepository.php` | No interfaces/DI bindings; injected by concrete class |
| Models | `app/Models`, `app/Models/Portfolio` | Eloquent, accessors for image fallbacks, slug generation in `Page::boot()` |
| Authorization | `app/Policies/{Post,Category}Policy.php` | Used by the post/category admin only |
| Views | `resources/views` (Blade), `resources/js` (Vue) | See stacks above |
| Config | `config/constants.php`, `config/settings.php`, `config/services.php` (zoho, recaptcha), `config/app.php` (`tiny_mce_api_key`, `facebook_pixel_id`) | |
| Console | `app/Console/Commands/GenerateSitemap.php`, schedule in `app/Console/Kernel.php` | `sitemap:generate` daily |
| Data | `database/migrations` (single DB), `database/seeders` (full site seed), `database/sql` (one-off production data patches, historical) | |
| Static theme | `public/css`, `public/js`, `public/fonts`, `public/images` | Pre-built theme, not processed by Vite |
| Built assets | `public/build` (git-ignored) | Vite output for the admin bundle |

## Global middleware worth knowing

`app/Http/Kernel.php` appends `Illuminatech\MultipartMiddleware\MultipartFormDataParser` globally so that `PUT`/`PATCH` multipart requests (admin update forms with file uploads, sent by Inertia as `_method=PUT`) get their files parsed. Keep it before anything that reads input.

## Error tracking and logging

- Sentry via `sentry/sentry-laravel` (`config/sentry.php`, `SENTRY_LARAVEL_DSN`). `App\Exceptions\Handler` uses the Laravel 10-style structure and explicitly reports exceptions to Sentry when its binding is present.
- Zoho SDK writes its own log at `<project>/php_sdk_log.log` (path is relative to `public/`).
- Debugbar is dev-only (`barryvdh/laravel-debugbar`); `storage/debugbar/` is git-ignored.

## Known legacy/inconsistencies (do not "fix" casually)

- `App\Http\Kernel` / `app/Console/Kernel.php` are the Laravel ≤10 structure even though the framework is 11 — the app was upgraded in place and does not use `bootstrap/app.php` middleware configuration.
- Route name `admin.dafault-pages` (typo) is referenced from Vue; renaming requires a sweep of `resources/js`.
- `docker-compose.yml` builds the Sail **8.3** runtime while `composer.json` requires `^8.2` and production runs PHP 8.2 (`deployment-config.json`). Use 8.2-compatible syntax.
- `config/constants.php` carries TODOs to move counts into the `settings` table; they are still constants.
