## 1. Asset Pipeline & Layout Isolation

- [x] 1.1 Create `resources/css/landing-saas.css` with Tailwind CSS v4 import and register the entry point in `vite.config.mjs`
- [x] 1.2 Create `resources/views/layouts/landing-saas.blade.php` featuring clean metadata, isolated Vite asset link, custom minimalist navigation header, and clean footer with zero legacy CSS imports
- [x] 1.3 Verify asset compilation by running `vendor/bin/sail npm run build` and checking the generated Vite manifest

## 2. Localization Dictionaries

- [x] 2.1 Create `lang/uk/saas.php` with comprehensive Ukrainian translations covering Hero, Proof of Work (DigiPulse, VetSpace, VetCard, NetPostPanel), SaaS Engine, working rules (test server in the first week, Unit & Playwright E2E testing, code ownership), 4-Sprint Roadmap, Engagement Models, FAQ, and Inquiry Form
- [x] 2.2 Create `lang/pl/saas.php` with matching Polish translation keys and exact structural parity
- [x] 2.3 Create `lang/en/saas.php` with matching English translation keys and exact structural parity
- [x] 2.4 Add `tests/Feature/SaasLandingLocalizationTest.php` asserting 100% key parity and non-empty translations across all 3 locales (`uk`, `pl`, `en`)

## 3. Controller & Routing

- [x] 3.1 Create `app/Http/Controllers/Development/SaasController.php` returning the view with localized SEO meta tags (canonical, alternate hreflang, OpenGraph, JSON-LD)
- [x] 3.2 Register the `development` route group in `routes/web.php` with `Route::prefix('{locale?}/development')->name('development.')->group(...)` containing `Route::get('saas', [SaasController::class, 'show'])->name('saas')`
- [x] 3.3 Verify HTTP 200 responses across `/uk/development/saas`, `/pl/development/saas`, and `/en/development/saas` via automated test

## 4. Landing Page View & Component Sections

- [x] 4.1 Create `resources/views/development/saas.blade.php` extending `layouts.landing-saas` with Hero section (badge, high-impact headline, subheadline, direct Telegram/email CTAs, and live status indicator)
- [x] 4.2 Build Proof of Work section featuring DigiPulse, VetSpace, VetCard, and NetPostPanel with architectural badges, and external live links
- [x] 4.3 Build SaaS Engine Bento Grid highlighting Multi-Tenancy, Stripe Subscriptions, Background Queues/Workers, Filament Ops Panel, and AI/RAG
- [x] 4.4 Build 4-Sprint Launch Roadmap, working rules (test server in the first week, Unit + Playwright E2E tests, code ownership, direct contact with the developer), and Transparent Engagement Models
- [x] 4.5 Build Social Proof section (Upwork client review, quoted as given) and FAQ accordion
- [x] 4.6 Build Streamlined Project Qualification Form (project idea, stage, timeline, Telegram/email contact) with localized success feedback

## 5. Verification & Code Quality

- [x] 5.1 Run `vendor/bin/sail bin pint --dirty --format agent` to guarantee PSR-12 and project style compliance
- [x] 5.2 Execute test suite via `vendor/bin/sail bin phpunit --filter=SaasLanding` to verify route, localization, and SEO functionality
- [x] 5.3 Verify visual presentation, responsiveness, and zero legacy CSS conflicts in browser

## 6. Review Fixes: Lead Flow & Security

- [x] 6.1 Add migration for nullable, indexed `contact_forms.source`; add `ContactForm::SOURCE_CONTACT_PAGE` / `SOURCE_SAAS_LANDING`; set `source` in `ContactController::save`
- [x] 6.2 Create `SaasInquirySaveRequest` (fields, stage/budget whitelists, `RecaptchaRule`, localized attribute names) and use it in `SaasController@inquiry`
- [x] 6.3 Push landing inquiries to Zoho via `ZohoLeadService`; keep non-email contacts out of `phone`
- [x] 6.4 Add "not specified" empty options to stage/budget selects, reCAPTCHA widget (theme + locale), translated error title

## 7. Review Fixes: Layout, SEO & Assets

- [x] 7.1 Remove `consent.js`, Consent Mode defaults and Meta Pixel from the landing layout (no consent banner there)
- [x] 7.2 Render JSON-LD via `@json` with Poznań / Wielkopolskie address and `areaServed`; switch OG image to `images/og-default.png`
- [x] 7.3 Add `development.saas` to `GenerateSitemap::STATIC_ROUTES` and the sitemap test
- [x] 7.4 Replace `@config` with `source(none)` + `@source` for the landing templates

## 8. Dark Theme

- [x] 8.1 Class-based `dark` variant and `color-scheme` in `landing-saas.css`; no-flash inline theme script in `<head>`
- [x] 8.2 Header toggle storing the choice in `localStorage`, following OS changes while no choice is saved
- [x] 8.3 Add `dark:` variants across the layout and landing view; keep already-dark blocks (code illustrations, MVP card, review) as they are

## 9. Copy Review & Local Positioning

- [x] 9.1 Rewrite `en`/`uk`/`pl` copy: no absolute guarantees or invented metrics, test server "first week" everywhere, neutral agency comparison, one name for the form outcome
- [x] 9.2 Remove GitHub "demo" buttons (they pointed at the profile root) and invented figures in the DigiPulse/VetSpace illustrations; translate hardcoded hero metric labels
- [x] 9.3 Add Poznań / Wielkopolska to SEO title/description, hero, header, footer and FAQ (q7)
- [x] 9.4 Replace the full-width review with two compact cards: verbatim excerpts from the Upwork review and LinkedIn recommendation, source labels, translation note for uk/pl

## 10. Verification

- [x] 10.1 Feature tests: inquiry stored with source and sent to Zoho, Telegram contact handling, reCAPTCHA required, unknown stage/budget rejected, no trackers + theme toggle present, main contact form stores `source = contact-us`, sitemap includes the landing
- [x] 10.2 `npm run build`, Pint, targeted PHPUnit run, visual check of light/dark at 1440px and 375px
