---
type: Guide
title: "Integrations"
description: "Configuration, request flow and failure behavior of the integrations implemented in DigiSpace."
tags: [integrations, zoho, uploads]
status: stable
stale_after: 2027-03-13
---

# Integrations

This describes repository behavior, not a live connectivity check. Environment values and credentials are intentionally omitted.

## Contact form → reCAPTCHA → database → Zoho

`POST /contact-us` (`contact.save`) uses [ContactFormSaveRequest](../app/Http/Requests/ContactFormSaveRequest.php). Required fields are `first_name`, `last_name`, `email`, international `phone`, `message` and `g-recaptcha-response`.

1. [RecaptchaRule](../app/Rules/RecaptchaRule.php) posts the token, secret and client IP to Google's verification endpoint using Laravel's HTTP client. It accepts the response's `success` flag; no score or hostname check is implemented. Rejected tokens fail validation; connection exceptions can propagate.
2. [ContactController::save](../app/Http/Controllers/ContactController.php) builds `name` from first and last name, then inserts `contact_forms`.
3. The controller calls the Zoho SDK synchronously, creating a Lead with name, email, phone, message and LeadSource `Online Store` in the US production data centre.
4. It redirects back with a success message when the method returns. Structured Zoho API errors are logged without changing that message. SDK initialization/transport exceptions are not caught here: a request can fail after its database insert. There is no transaction spanning both systems, queued retry or deduplication.

| Configuration | Source / consumer |
|---|---|
| `RECAPTCHA_SITE_KEY`, `RECAPTCHA_SECRET_KEY` | `config/services.php`, Blade form and `RecaptchaRule` |
| `ZOHO_CLIENT_ID`, `ZOHO_CLIENT_SECRET`, `ZOHO_GRANT_TOKEN` | `config/services.php`, `zohoInitializer()` |

Leaving Zoho credentials blank is not a disable switch. For isolated tests, fake reCAPTCHA with `Http::fake()` and introduce a mockable boundary around the Zoho SDK; Laravel HTTP fakes do not intercept that SDK. Do not send real leads merely to test rendering.

Zoho's `../zohoStore.txt` and `../php_sdk_log.log` are relative paths, normally at the project root when PHP runs from `public/`; CLI working directories may differ. The token store contains credentials, and controller logs include submitted personal data. Keep their contents out of documentation. The release workflow does not explicitly preserve these root files: inspect their actual location and persistence before deploying integration changes.

## Images and storage

[config/filesystems.php](../config/filesystems.php) defines `s3` using `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, **`MINIO_BUCKET`**, **`MINIO_ENDPOINT`**, `AWS_URL` and `AWS_USE_PATH_STYLE_ENDPOINT`. `AWS_BUCKET` from the example environment does not configure this disk. MinIO is not included in Docker Compose.

| Upload | Implementation | Persistence |
|---|---|---|
| Widget image | `Admin/WidgetController::storeWidgetImageOnMinio` | S3 object; absolute URL stored in `widget_image` |
| Post image | `Admin/PostController::storeImageOnMinio` | S3 object; absolute URL stored in `img_path` |
| Service image | `Admin/ServiceController` | File moved to `public/uploads`; filename stored in DB |
| Blog banner | `Admin/BlogPostBannerController` | File moved to `public/banners`; filename stored in DB |

The S3 disk has `throw=false`; upload helpers do not inspect the boolean returned by `put()`. A saved URL alone does not prove an object was uploaded. Check object existence and browser access separately. See [deployment](deployment/README.md) for local image copying between releases.

## Editor, tracking and mail

- **TinyMCE:** `TINY_MCE_API_KEY` maps to `config('app.tiny_mce_api_key')`; Vue forms use `@tinymce/tinymce-vue`. Inspect the individual controller's props: the key is not shared globally and some edit actions omit it.
- **Sentry:** `SENTRY_LARAVEL_DSN` is read by `config/sentry.php`; [Handler](../app/Exceptions/Handler.php) explicitly calls `captureException()` when Sentry is bound. Installing the package alone does not verify delivery.
- **Facebook Pixel:** `FACEBOOK_PIXEL_ID` maps through `config/app.php` into `resources/views/layouts/main.blade.php`.
- **Google map:** inspect `resources/views/components/google-map.blade.php`; the map is public Blade content, not an Azure or custom maps service.
- **Mail:** Breeze password reset uses Laravel mail configuration. Compose has no Mailhog service despite `.env.example` referencing it; `MAIL_MAILER=log` is useful locally. Contact form delivery itself is database + Zoho, not an email notification.

## Sitemap

[GenerateSitemap](../app/Console/Commands/GenerateSitemap.php) uses Spatie's crawler against `APP_URL`, writes `public/sitemap.xml`, and assigns priority `0.8`. Blog paths receive monthly change frequency; others receive `never`.

The command is scheduled daily in [Console Kernel](../app/Console/Kernel.php). A server scheduler invoking `artisan schedule:run` is still required; the deployment workflow does not provision it. The crawler performs real network requests and is not intercepted by Laravel `Http::fake()`. Test with an isolated local server or an injectable crawler boundary. A generated sitemap is release-local and may be replaced by the next artifact.

[Documentation index](README.md)
