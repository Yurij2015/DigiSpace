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

## 11. Conversion & Compliance Audit Fixes

- [x] 11.1 Mobile sticky CTA to `#contact` (shown after the hero, hidden near the form/footer)
- [x] 11.2 Move client reviews right after the projects, before pricing
- [x] 11.3 RODO/GDPR notice under the inquiry form with a link to the privacy policy
- [x] 11.4 Self-host fonts (Plus Jakarta Sans latin/latin-ext + Manrope Cyrillic for Ukrainian); drop Google Fonts and the unused JetBrains Mono
- [x] 11.5 Load reCAPTCHA only when the visitor approaches or focuses the form
- [x] 11.6 `FAQPage` JSON-LD, `aria-pressed` on the theme toggle, sprint number contrast, shorter hero subtitle
- [x] 11.7 Founder block after the reviews: photo (Web Summit selfie cropped to the face, 320×320, `public/landing/yurii-mokryi.jpg`), role, bio, verified facts, LinkedIn/GitHub/Upwork links
- [x] 11.8 Legal data in footer (Yurii Mokryi JDG, NIP, REGON), data controller in the form notice, net + Polish VAT note under pricing, `legalName`/`vatID` in JSON-LD, Upwork review linked to the profile
- [x] 11.9 Conversion measurement: shared cookie banner + consent-gated GA4, Meta Pixel and Clarity on the landing (tracker snippets and banner CSS extracted into `partials/tracking/*` and `public/css/cookie-consent.css`, reused by the main site); `generate_lead`/`Lead` after a stored inquiry, `contact`/`Contact` on Telegram/e-mail clicks
- [x] 11.12 Form stays the primary action; Telegram sits next to it in the hero, the mobile sticky bar and under the form
- [x] 11.13 Copy re-read: chat-first FAQ answer, no duplicated 8+ years, UA/PL wording fixes, unused keys removed
- [x] 11.14 Invisible reCAPTCHA v3 on the landing form (`RecaptchaV3Rule`: success + action `saas_inquiry` + score ≥ `RECAPTCHA_V3_MIN_SCORE`, default 0.5); token requested on submit, badge hidden with the required Google notice; new `RECAPTCHA_V3_SITE_KEY`/`RECAPTCHA_V3_SECRET_KEY` wired through `config/services.php`, `.env.example`, `deploy.yml` and `compose-env.sh`. The main contact form keeps the v2 checkbox.
- [ ] 11.15 Create the v3 key pair in Google reCAPTCHA admin and add it to local `.env` and the testing/production GitHub Variables/Secrets **before deploying** (without it the landing form rejects every submission)
- [x] 11.10 Real product screenshots: per-project galleries (swipe on mobile, arrows on desktop, `<dialog>` lightbox), 7 WebP shots in 800/1600 px under `public/landing/screens/` — VetSpace Swagger, Filament plans, clinic calendar (local env, Turnstile test keys restored afterwards, temporary admin deleted); NetPostPanel Workbench and Auto Pilot (local); DigiPulse dashboard and site history (testing site, site names, domains, IPs and e-mail blurred)
- [x] 11.16 Dedicated OG images per landing and locale: `public/landing/og-{saas,business}-{uk,pl,en}.png` (1200×630, rendered from each page's own hero copy), `og:image`/`twitter:image` chosen by `$copy` + locale with a `?v=` cache buster and `images/og-default.png` as fallback; kept out of `public/images`, which deploys restore from the previous release (call booking deferred: contact goes through chat first)
- [x] 11.11 YouTube / TikTok / Instagram links in the founder block, after the professional profiles

## 12. Landing Restructure (sales page → short funnel)

- [x] 12.1 Order: hero (price anchor in the trust bar) → projects → founder with reviews → how we work → pricing → FAQ → form; mobile length 22.7 → 14.2 screens, pricing from screen 17 to 8
- [x] 12.2 Project cards in a 3-column grid: cover screenshot + shot count, badge, name, tagline, stack, link; long descriptions, code/pipeline illustrations and the VetSpace mock card removed; the lightbox pages through all shots of the project (buttons, arrow keys, counter)
- [x] 12.3 Working rules, the 4-sprint plan (weeks + one-line result, no deliverable lists) and the building blocks (label chips) merged into one "how we work" section ending with a CTA to the form
- [x] 12.4 Agency comparison table replaced by one neutral line under the prices; FAQ q5 (duplicate of the testing rule) removed; nav reduced to Projects · How we work · Pricing · FAQ
- [x] 12.5 VetSpace clinic calendar re-shot on a local demo clinic with fake Polish data (caption marks it as demo data) and used as the VetSpace cover
- [ ] 12.6 After the landing is finished: move the parked texts from `removed-content.md` (project architecture, building-block descriptions, agency comparison, sprint deliverables) to case-study pages, `/about` or `/services` as suggested there

## 13. UX/UI Polish (review 2026-09-28)

- [x] 13.1 Cookie bar on phones (shared with the main site): compact full-width bar, heading kept for screen readers only, 44px buttons; mobile hero tightened with a short subtitle and a short CTA label, so the main CTA stays above the bar on every phone size and both CTAs from 780px height
- [x] 13.2 One primary action with one name: header CTA, hero, sticky bar and the submit button all say "Get an estimate" and lead to the form; reply time next to the submit button
- [x] 13.3 Form: 16px fields on phones (no iOS zoom), `autocomplete` hints, sentence-case labels
- [x] 13.4 Project cards: zoomed cover crops (`{file}-cover.webp`), three headline technologies as plain text; building blocks as a check-list instead of button-like chips; the sprint plan as a timeline instead of cards
- [x] 13.5 Pricing cards aligned on a shared subgrid, "net" next to each price; founder block keeps LinkedIn/GitHub/Upwork prominent and moves video channels to a secondary line
- [x] 13.6 Accessibility: skip link, visible keyboard focus everywhere (logo included), `prefers-reduced-motion`, AA contrast for small grey labels, anchors offset below the fixed header, static availability dot, sticky CTA ignores the hero edge hidden under the header
- [x] 13.7 Tests: `e2e/saas-landing.spec.ts` (Playwright, 4 phone sizes + desktop: cookie bar vs CTA, overflow in all locales, tap targets, 16px fields, sticky CTA, anchors, pricing alignment, lightbox, skip link, focus, contrast, reduced motion) and a PHPUnit UX-contract test

## 14. Copy Consistency

- [x] 14.1 "6–8 weeks" and the plan agree: four stages of up to two weeks, shorter for a smaller scope (process subtitle and FAQ q1); one term — "stage" / "етап" / "etap" — in the plan, pricing subtitle and payment FAQ (25% at the start of each of the four stages)
- [x] 14.2 No absolute promise in stage 1 ("architecture with room to grow"); the agency line explains the lower budget without unverifiable figures
- [x] 14.3 "Fractional CTO" renamed to "Senior support" / "Senior-підтримка" / "Wsparcie senior" to match what the plan contains
- [x] 14.4 The form comes first wherever contact is described (contact subtitle, FAQ "what do you need from me")

## 15. Business Landing (same offer, business language)

- [x] 15.1 `/{locale}/development/business` (`development.business`, POST `development.business.inquiry`): the same template as the SaaS landing (`development/landing.blade.php`), rendered by `LandingController` (was `SaasController`) with `$copy` = `saas` | `business`, `$landingRoute` and `$leadSource`
- [x] 15.2 `lang/{en,uk,pl}/business.php`: same keys as `saas.php`, copy for business owners (online booking, client portal, CRM, internal tools; no jargon), same prices, stages and rules; Polish title "System szyty na miarę Twojej firmy"
- [x] 15.3 Leads stored with `source = development-business`, validation labels from the business form, sitemap entry, canonical/hreflang/JSON-LD per landing
- [x] 15.4 Mobile fit: status-only hero badge on phones, shorter Polish SaaS title, tighter cookie-bar buttons; e2e layout checks on both landings in all locales; banner resize test on the main site and the business landing
- [x] 15.5 A Zoho failure after the lead is stored is reported (log/Sentry) instead of showing an error page, so visitors don't resubmit
- [x] 15.6 Logo: city line ("Poznań") justified letter by letter to the wordmark's width; the D's body spans cap height → city baseline from sm, centred on the capitals on phones (measured on rendered fonts, e2e-guarded)
- [x] 15.9 `development.business` registered in `config('locales.route_names')`, so `Locales::localizedPath()` and the global language switch resolve it
- [x] 15.7 Tests: `BusinessLandingTest` (key parity with saas.php, render per locale, lead source, CRM failure, localized validation), sitemap test
- [x] 15.8 Product landings for VetSpace and DigiPulse on digispace.pro: dropped (2026-09-28) — they would compete in search with the products' own landings on vetspace.pro and digipulse.cloud; on digispace.pro the products stay as project cards linking to their sites

## 16. Theme-aware screenshots

- [x] 16.1 Every gallery shot may have a dark twin (`{file}-dark.webp`, `-dark-800`, `-dark-cover`): covers switch with `dark:` classes, the lightbox picks `srcDark` when `<html>` has `.dark`
- [x] 16.2 VetSpace: month calendar added (light + dark, even demo month), dark week calendar and dark Filament admin; Swagger has no dark UI and stays light in both themes
- [x] 16.3 NetPostPanel: dark Workbench and Auto Pilot (local); DigiPulse: dashboard and site history re-shot in both themes in one session from the owner's browser, with site names (incl. the history title), domains, IPs and the e-mail blurred
- [x] 16.4 Tests: dark twins have every size and are wired into the page (PHPUnit); the light/dark theme shows the matching cover and lightbox image, the lightbox test counts shots from the gallery data (Playwright)
