---
type: Implementation Plan
title: "Tasks — public site UX/UI audit fixes"
description: "Ordered, verifiable steps to implement the P1/P2 findings of the public site audit."
tags: [tasks, public-site, ux, testing]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: proposal
    resource: repo://openspec/changes/public-site-ux-ui-audit/proposal.md
  - id: design
    resource: repo://openspec/changes/public-site-ux-ui-audit/design.md
  - id: testing-docs
    resource: repo://docs/testing.md
---

All test commands run through Sail (`vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit …`) against the `testing` MySQL database; run `vendor/bin/sail artisan config:clear` first if `config:cache` was ever used. Run `vendor/bin/sail bin pint --dirty --format agent` and `vendor/bin/phpstan analyse` before finishing each group.

## 1. Test fixtures

- [x] 1.1 Extract the `setUp` fixture from `tests/Feature/ExampleTest.php` into a `tests/Feature/Concerns/SeedsPublicSite` trait (seeders, explicit widget-category IDs, `ContentServiceProvider` re-boot) and make `ExampleTest` use it; verify `phpunit --filter=ExampleTest` still passes.

## 2. Navigation and reachability (spec `public-site/navigation`)

- [x] 2.1 Add `Route::fallback()` in `routes/web.php` (after `auth.php`) that re-matches `/{resolved locale}{path}` against GET routes in `config('locales.route_names')` and 302-redirects (query preserved) or aborts 404 (design D1); verify with `curl -I localhost:8100/about` → 302 to `/en/about`, `curl -I localhost:8100/admn` → 404.
- [x] 2.2 Write `tests/Feature/LegacyUrlRedirectTest.php` covering `/about`, `/blog/{slug}`, `/faq`, `/contact-us?x=1` (302 to prefixed URL with query), `/uk/about` (200 unchanged), `/this-does-not-exist` (404), and that a POST to `/contact-us` is not redirected; verify it passes.
- [x] 2.3 Create `resources/views/errors/404.blade.php` extending `layouts.main`, move the not-found copy into a shared partial used by `errors/page-not-found.blade.php` and `errors/nothin-found.blade.php`, replace the wrong title/heading with `__('site.not_found_*')` keys (design D2); verify `curl localhost:8100/uk/nope` returns 404 with the site header and Ukrainian copy.
- [x] 2.4 Write `tests/Feature/NotFoundPageTest.php`: unmatched route, missing page slug and missing blog slug all return 404 with header/footer markup, correct `<title>`, and localized copy for `pl` (session locale); verify it passes.
- [x] 2.5 Add `Locales::localizeUrl()` and use it in `footer-bottom-bar-content.blade.php` (design D3); verify `curl localhost:8100/uk | grep -o 'href="[^"]*faq"'` shows `/uk/faq` and `tests/Unit/LocalesTest.php` gains cases for internal path, external URL and already-prefixed path.
- [x] 2.6 Fix `home/index.blade.php` slide 2 background to `asset('images/slider-second-home-page.jpg')`, remove `<div id="app"><navbar></navbar></div>`; verify every `data-slide-bg`/`data-parallax-img`/`src` URL in `curl localhost:8100/uk` responds 200 (reuse the audit one-liner).
- [x] 2.7 Point the header search form at `route('service-search')` with `name="search"`, localize its label, and check the theme live-search JS for console errors (drop `data-search-live` if needed, design D9); verify submitting a query from `/uk` lands on `/uk/service-search?search=…` with 200.
- [x] 2.8 Replace `href="#"` placeholders: blog author name as plain text (`blog/index`, `blog/post_show`), About-page social icons via the `SocialLink` component with real URLs from `widgetIcon->url` or removed when empty, "Pages" label as a `<span>`/button-like element the theme dropdown still opens; verify `grep -rn 'href="#"' resources/views` (excluding `vendor`) returns nothing.

## 3. Lead forms (spec `public-site/lead-forms`)

- [x] 3.1 Rework `components/contact-form.blade.php`: `old()` values, per-field `@error`, matching `for`/`id`, `required`, `autocomplete`, `type="tel"`, all labels/heading/button/success text via `__('site.contact_*')` (design D4); verify the rendered form on `/pl/contact-us` shows Polish labels and `autocomplete="email"`.
- [x] 3.2 Change `ContactController::save` to flash `__('site.contact_success')`; verify a manual valid submission on `/uk/contact-us` shows the Ukrainian confirmation.
- [x] 3.3 Write `tests/Feature/ContactFormFeedbackTest.php` with `Http::fake()` for reCAPTCHA: invalid e-mail keeps the other four values and shows only the e-mail error; missing first name shows the error label with `for="first-name"`; valid submission (Zoho boundary faked or tolerated per design D4) stores a `contact_forms` row and flashes the localized success; verify it passes.
- [x] 3.4 Rework the footer subscribe form (design D5): remove `rd-mailform`/`data-form-*`, add `old('email')`, `@error('email', 'subscribe')`, flash `subscribe_success`, localized button/labels; change `SubscriberController::save` to `validateWithBag('subscribe', …)` and a localized flash; verify submitting `nope` in the footer shows the validation message inline and a valid e-mail shows the confirmation.
- [x] 3.5 Write `tests/Feature/SubscribeFormFeedbackTest.php`: invalid e-mail → error in the `subscribe` bag rendered in the footer with value preserved; duplicate e-mail → unique error; valid → `subscribers` row + localized flash; contact-form e-mail error does not appear in the footer; verify it passes.

## 4. Localized chrome (spec `public-site/localized-ui`)

- [x] 4.1 Add the new keys to `lang/en/site.php`, `lang/uk/site.php`, `lang/pl/site.php` (breadcrumbs, page titles, section headings, buttons, form labels, 404 copy, hero slides, toggle labels) with translations; verify `php -r` key-set diff between the three files is empty.
- [x] 4.2 Write `tests/Unit/SiteDictionaryParityTest.php` asserting identical key sets and non-empty values across `en`/`uk`/`pl`; verify it passes.
- [x] 4.3 Replace hard-coded strings in `home/index.blade.php` (hero + "Pricing Plans"), breadcrumb sections of `about|blog|services|services/search|services/service-category|prices|contact|pages/show|footer-pages|promo|errors/*`, `components/blog-aside.blade.php`, `components/our-services-component.blade.php`, `components/footer.blade.php` and page `@section('title')` values with `__('site.*')`; verify `grep -rnoE ">(Home|Read More|Pricing Plans|Our Services|Categories|Archive|by|Subscribe|Send Message)<" resources/views` (excluding `vendor`) returns nothing.
- [x] 4.4 Write `tests/Feature/LocalizedChromeTest.php`: `/uk/about` breadcrumb and `<title>` are Ukrainian; `/uk` hero `<h1>` is Ukrainian and its CTA links to `/uk/pages/...`; `/pl/contact-us` heading/labels are Polish; verify it passes.
- [x] 4.5 Language switcher (design D7): add `short_labels` to `config/locales.php`, render labels from it, add a `<noscript>` link list, move the inline `<style>` to `public/css/site.css` linked in `layouts/main.blade.php`; verify `ExampleTest::test_localized_public_routes_expose_language_and_alternates` still passes and the switcher does not overlap the toggle/logo at 320, 360 and 390 px (use the `run` skill or a manual check — the Chrome extension could not load localhost during the audit).

## 5. Accessibility baseline (spec `public-site/accessibility`)

- [x] 5.1 Create `App\View\Components\SocialLink` (`href`, `icon`, optional `label`; derives `aria-label` from the Font Awesome class, adds `target="_blank" rel="noopener"`) and use it in `header-navbar-content`, `footer` ("About us" icons) and `about/index.blade.php` (design D8); verify `curl localhost:8100/uk | grep -c 'icon-style-brand'` links all carry `aria-label`.
- [x] 5.2 Set `alt="{{ config('app.name') }}"` on both logo images, `alt="{{ $widget->title }}"` on client/technology/choose-us/about widget images, add `aria-label` to the navbar toggle, search toggle and search submit from `site.php` keys, and remove the stray `;` in `header.blade.php`; verify `grep -o '<img[^>]*>' <(curl -s localhost:8100/uk) | grep -c 'alt=""'` only counts genuinely decorative images and the Services `<li>` has no stray text when a service category exists (seed one locally).
- [x] 5.3 Write `tests/Feature/PublicAccessibilityTest.php`: logo `alt`, social links `aria-label`+`rel="noopener"`, toggles `aria-label`, language `<select aria-label>` in `uk`, no `;` text node inside `.rd-navbar-nav` when a service category is seeded, no `<div id="app">` on `/`; verify it passes.

## 6. Integration verification

- [x] 6.1 Run the full PHPUnit suite, `vendor/bin/phpstan analyse` and `vendor/bin/sail bin pint --dirty --format agent`; verify all green.
- [x] 6.2 Smoke the running stack with `curl` for `/`, `/uk`, `/pl`, `/about` (302), `/uk/about`, `/blog`, `/uk/blog/<slug>`, `/faq`, `/nope` (branded 404), and the audit asset-URL one-liner on `/uk`; verify no 404 assets and no English chrome strings on `/uk`.
- [x] 6.3 Update `2026-09-localization-filament/tasks.md` Phase 1 note to reference this change for the unprefixed-URL compatibility (no code), and record the client-logo data question from design "Open Questions" as a follow-up in that change or a new one; verify the cross-reference exists.
