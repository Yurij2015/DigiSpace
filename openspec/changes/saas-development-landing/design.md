## Context

DigiSpace runs on Laravel 13 with PHP 8.3+, Vite, and Tailwind CSS v4. The public application routes are localized with supported locales (`uk`, `pl`, `en`) under the `{locale?}` route group. The current main website templates load legacy styling and navigation components that are optimized for traditional corporate presentation. To test demand and run focused Google Ads campaigns for high-ticket SaaS MVP development, an isolated, modern, high-converting landing page is required.

Market research in Poland and the EU reveals key founder dynamics:
1. **Market Price vs Value**: Polish software houses charge 60,000–150,000 PLN ($15k–$37k) with high administrative overhead (PMs, junior developers, account managers) and 4–6 month delivery cycles.
2. **Founder Pain Points**: Top friction points are "over-engineering traps" (building complex microservices instead of rapid validation), "feature bloat/creep", opaque pricing, and fear of vendor lock-in.
3. **The DigiSpace Strategic Sweet Spot**: Fixed 6–8 week SaaS MVP Sprint priced around 18,000–38,000 PLN ($4,500–$9,500), direct collaboration with a Senior Full-Stack Architect, 100% code/infrastructure ownership on the client's cloud, and production-tested architecture.
4. **Transparency & Reliability**: A password-protected test server in the first week (the product is visible instead of status reports) plus automated Unit and Playwright E2E tests on every push that catch regressions in billing and core user journeys early. The copy never promises zero bugs.
5. **Local trust**: DigiSpace is based in Poznań. Local founders in Poznań and Wielkopolska value the option of meeting in person, and local signals (copy, FAQ, JSON-LD `areaServed`) support regional search queries.

See `proposal.md` for motivation and `specs/public-site/saas-landing/spec.md` for behavioral requirements.

## Goals / Non-Goals

**Goals:**
- Provide a dedicated, localized public route group `/{locale}/development/` with the flagship SaaS offering at `/{locale}/development/saas` (`uk`, `pl`, `en`), named `development.saas`.
- Maintain 100% style isolation from legacy CSS by utilizing a dedicated Vite entry point (`resources/css/landing-saas.css`) and standalone Blade layout (`resources/views/layouts/landing-saas.blade.php`).
- Deliver a minimalist UI with clean whitespace, refined typography and subtle borders, in a light and a dark theme (OS preference by default, explicit visitor choice remembered).
- Showcase in-house SaaS platforms (`DigiPulse`, `VetSpace & VetCard`, `NetPostPanel`) with architecture highlights and live links, without invented metrics.
- Describe the 6 building blocks of a typical SaaS MVP and a 4-sprint launch plan.
- Explain the differences from a typical agency in neutral terms (direct access to the developer, ownership of code and infrastructure via Docker/CI-CD).
- State delivery commitments consistently: test server in the first week, Unit and Playwright E2E tests on every push.
- Position DigiSpace locally for Poznań and Wielkopolska without keyword stuffing.
- Provide clear contact actions (Telegram, email and a short inquiry form) and record the page of origin for every lead.
- Ensure strict parity across English, Ukrainian, and Polish localization files.

**Non-Goals:**
- Modifying the existing main site navigation, home page, or footer layouts.
- Altering the legacy `/admin` or Filament `/control` panels.
- Referencing external employers, third-party clients, or trademarked external brands (e.g. Platinium Group, Formula 1) on public advertising surfaces, ensuring 100% legal safety and ethical separation.

## Decisions

### 1. Dedicated Route Group `development` and Controller Namespace
- **Rationale**: Organizing under `/{locale}/development/saas` creates a clean, premium architecture that scales effortlessly for future engineering offerings (`/development/mvp`, `/development/ai-systems`). The controller lives cleanly in `App\Http\Controllers\Development\SaasController`.
- **Route registration**:
  ```php
  Route::prefix('{locale?}/development')
      ->whereIn('locale', config('locales.supported'))
      ->name('development.')
      ->group(function (): void {
          Route::get('saas', [App\Http\Controllers\Development\SaasController::class, 'show'])->name('saas');
      });
  ```
- **Alternatives Considered**: Using `/{locale}/saas-development` or `/landing/saas`. *Rejected* in favor of `/development/saas` because it builds a permanent, authoritative service category that looks premium in ad URLs and improves organic search equity.

### 2. Dedicated Blade Layout (`layouts/landing-saas.blade.php`)
- **Rationale**: Isolates the landing page DOM completely. It includes a custom minimalist header (logo with location, theme toggle, language switcher, "Discuss a project" CTA) and footer without loading any legacy scripts, modals or stylesheets. It deliberately does not load `consent.js`, Meta Pixel or Google Analytics: the cookie banner's styles live in the legacy `site.css`, so without a banner no tracker may load.
- **Alternatives Considered**: Using conditional `@if` statements inside `resources/views/layouts/app.blade.php`. *Rejected* because it creates brittle coupling, risks regression across existing site pages, and leaks global CSS reset rules.

### 3. Isolated Tailwind CSS Asset Entry (`resources/css/landing-saas.css`)
- **Rationale**: Compiled independently by Vite using `@import "tailwindcss" source(none);` with `@source` limited to `resources/views/development` and the landing layout. It does NOT use `@config "tailwind.config.js"`, because that config scans all admin views/Vue files and adds the `@tailwindcss/forms` plugin and the Nunito font. Dark mode is class-based (`@custom-variant dark (&:where(.dark, .dark *))`) and `color-scheme` follows the `.dark` class. The bundle is about 50KB (≈9KB gzip) with both themes.
- **Alternatives Considered**: Inlining CSS or CDN script tags. *Rejected* due to performance, maintainability, and lack of versioned asset hashing.

### 4. Dedicated Translation File Structure (`lang/{locale}/saas.php`)
- **Rationale**: Creates `lang/en/saas.php`, `lang/uk/saas.php`, and `lang/pl/saas.php`. Keeps the extensive SaaS copy, technical specs, sprint descriptions, staging & testing guarantees, and FAQ well-organized and isolated from general site labels.
- **Alternatives Considered**: Adding keys directly to `lang/{locale}/site.php`. *Rejected* to prevent cluttering global site dictionary files.

### 5. Controller & Lead Flow Architecture
- **Rationale**: `SaasController@show` renders `development.saas`. `SaasController@inquiry` accepts a dedicated form (name/company, Telegram or email, stage, budget, description) validated by `SaasInquirySaveRequest` with `RecaptchaRule`, behind `throttle:contact-form`. It stores a `ContactForm` row and pushes the same lead through `ZohoLeadService`, so landing leads land in the CRM like the main contact form.
- **Contact handling**: an email goes to `email`; any other value (e.g. a Telegram handle) stays only in `message`, never in `phone`.
- **Alternatives Considered**: reusing `ContactController@save`. *Rejected* because its request requires first/last name, email AND an international phone number, which does not fit a Telegram-first founder audience.

### 6. Lead source column
- **Rationale**: `contact_forms.source` (nullable, indexed, string 64) records the page of origin: `ContactForm::SOURCE_CONTACT_PAGE = 'contact-us'`, `ContactForm::SOURCE_SAAS_LANDING = 'development-saas'`. Stable keys, not URLs, so locale and URL changes do not split the statistics. Historical rows stay `NULL`. The source is also written into the Zoho lead description for the landing, because the Zoho `Lead_Source` picklist is fixed.

### 7. Theme selection
- **Rationale**: an inline script in `<head>` sets `html.dark` before first paint from `localStorage['saas-theme']`, falling back to `prefers-color-scheme`. The toggle writes the explicit choice; without a saved choice the page follows live OS changes. `localStorage` is enough here because it is a per-visitor convenience; every access is wrapped in `try/catch`. The reCAPTCHA widget gets `data-theme` from the same class before `api.js` loads.

### 8. Copy principles
- **Rationale**: the copy must be verifiable. No absolute guarantees ("zero regressions", "hallucination-free"), no invented dashboard figures, no "most popular" badges, a neutral agency comparison, one name for the form outcome (a scope and timeline estimate), and one test-server timing (first week) everywhere. Client feedback uses verbatim excerpts from the original Upwork review and LinkedIn recommendation (as published on the portfolio), dropping hyperbole ("coding machine", "the only one on Upwork", pay-rate remarks); no rating stars or author roles that the source does not show.

## Risks / Trade-offs

- **[Risk] Vite manifest build requirement** → *Mitigation*: Register `resources/css/landing-saas.css` in `vite.config.mjs`; CI runs `npm run build` before deployment.
- **[Risk] Spam through the inquiry form** → *Mitigation*: reCAPTCHA plus `throttle:contact-form`; the testing domain must be allowed for the shared site key.
- **[Risk] No analytics on the landing** → *Mitigation*: accepted for now; adding tracking requires bringing the consent banner (and its styles) into the isolated layout first.
- **[Risk] reCAPTCHA theme after toggling** → *Trade-off*: the widget keeps the theme it was rendered with until reload.
- **[Risk] Translation dictionary desynchronization** → *Mitigation*: Write a feature test (`SaasLandingLocalizationTest`) asserting that all keys in `lang/en/saas.php`, `lang/uk/saas.php`, and `lang/pl/saas.php` have 100% identical structures and non-empty values.
- **[Risk] SEO canonical and alternate hreflang tags** → *Mitigation*: the landing layout renders `canonical`, hreflang (`uk`, `pl`, `en`, `x-default`), OpenGraph with `images/og-default.png` (a dedicated OG image can replace it later) and JSON-LD via `@json`; the route is part of the sitemap.
