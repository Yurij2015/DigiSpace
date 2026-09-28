## Why

DigiSpace is launching advertising and outreach campaigns for SaaS MVP development, custom web architecture and multi-tenant applications, with a local focus on Poznań and Wielkopolska and a wider reach across Poland and the European Union. Low-end websites are commoditized, whereas startup founders and B2B operators need a solid architectural base (multi-tenancy, Stripe billing, background workers, AI pipelines). A dedicated multilingual (`uk`, `pl`, `en`) landing page under a scalable `development` services category is required to validate demand and turn traffic into qualified inquiries and discovery calls, backed by DigiSpace's own live production platforms.

## What Changes

- Introduce a dedicated public route group `/{locale}/development/` with the flagship SaaS offering at `/{locale}/development/saas` supporting all 3 active locales (`uk`, `pl`, `en`), plus a `POST /{locale}/development/saas-inquiry` endpoint for the inquiry form.
- Build an isolated asset pipeline (`resources/css/landing-saas.css`) with Tailwind CSS v4 that scans only the landing templates (`@source`), so neither the legacy theme CSS nor the admin Tailwind config leaks into the page.
- Implement a dedicated layout (`resources/views/layouts/landing-saas.blade.php`) with a minimalist light design and a dark theme: it follows the OS preference by default, and a header toggle stores the visitor's explicit choice.
- Present live proof of work using in-house production systems only:
  - **DigiPulse (`digipulse.cloud`)**: uptime monitoring SaaS (Laravel Octane, Go workers, Redis, MCP server).
  - **VetSpace & VetCard (`vetspace.pro`)**: multi-tenant clinic platform (Nuxt SSR, Stripe subscriptions, custom subdomains).
  - **NetPostPanel** (not public; linked to its descriptive repository `github.com/Yurij2015/net-post-panel-overview`): AI content platform (RAG pipeline, Qdrant, Langfuse, Horizon queues).
  - Two compact client quotes: excerpts from an Upwork client review and a LinkedIn recommendation, taken verbatim from the source (omissions marked with “…”, uk/pl marked as translations).
- Describe the 6 building blocks of a typical SaaS MVP (multi-tenancy, Stripe subscriptions, background jobs, Filament admin, AI/RAG, Docker deployment).
- Describe the 4-sprint launch plan (architecture, core features & payments, user area & admin, testing & launch).
- Position DigiSpace locally: based in Poznań, in-person meetings possible in Poznań and Wielkopolska, remote work for the rest of Poland and abroad (copy, FAQ, SEO title/description, JSON-LD `areaServed`).
- Keep the copy factual: no absolute guarantees, no invented metrics or mock figures, a neutral comparison with a typical agency, and one consistent name for what the form delivers (a scope and timeline estimate).
- Implement a contact section: Telegram, email and a short inquiry form protected by reCAPTCHA. Inquiries are stored in `contact_forms` with a `source` marker and pushed to Zoho CRM.
- Record the page of origin for every lead: new nullable `contact_forms.source` column (`contact-us` for the main contact page, `development-saas` for this landing).
- Provide localized SEO metadata, hreflang, OpenGraph tags, JSON-LD structured data and a sitemap entry for the landing page.

## Capabilities

### New Capabilities
- `public-site/saas-landing`: dedicated, isolated, multilingual (`uk`, `pl`, `en`) SaaS development landing page at `/{locale}/development/saas` with light/dark themes, live in-house proofs, MVP building blocks, a sprint plan, local Poznań/Wielkopolska positioning and a spam-protected inquiry form whose leads carry their source.

### Modified Capabilities
<!-- The main contact form now also stores `source = contact-us`; its behavior is otherwise unchanged. -->

## Impact

- **Routing**: adds a `development` route group in `routes/web.php` (`development.saas`, `development.saas.inquiry` with `throttle:contact-form`); `development.saas` is added to `config/locales.php` `route_names`.
- **Controllers / requests**: creates `app/Http/Controllers/Development/SaasController.php` and `app/Http/Requests/SaasInquirySaveRequest.php`; `ContactController::save` sets `source`.
- **Database**: migration adding nullable, indexed `contact_forms.source` (string, 64); constants `ContactForm::SOURCE_CONTACT_PAGE` / `SOURCE_SAAS_LANDING`.
- **Integrations**: landing inquiries go through the existing `ZohoLeadService`; the form uses the existing `RecaptchaRule`.
- **Views**: creates `resources/views/layouts/landing-saas.blade.php` and `resources/views/development/saas.blade.php`.
- **Assets**: adds `resources/css/landing-saas.css` and registers it in `vite.config.mjs`.
- **SEO**: `development.saas` is added to `GenerateSitemap::STATIC_ROUTES`.
- **Localization**: adds `lang/{locale}/saas.php` for Ukrainian, Polish and English.
- **Dependencies**: none; uses the existing Tailwind CSS v4 and Vite toolchain.
