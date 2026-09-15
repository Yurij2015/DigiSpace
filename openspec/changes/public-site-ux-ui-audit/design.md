---
type: Design
title: "Design — public site UX/UI audit fixes"
description: "How the P1/P2 findings from the public site audit are fixed without touching the admin surfaces or the in-flight translation storage work."
tags: [design, public-site, ux, localization, forms, accessibility]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: routes
    resource: repo://routes/web.php
  - id: set-locale
    resource: repo://app/Http/Middleware/SetLocale.php
  - id: locales-helper
    resource: repo://app/Support/Locales.php
  - id: content-provider
    resource: repo://app/Providers/ContentServiceProvider.php
  - id: example-test
    resource: repo://tests/Feature/ExampleTest.php
  - id: recaptcha-rule
    resource: repo://app/Rules/RecaptchaRule.php
  - id: localization-spec
    resource: repo://openspec/specs/architecture/localization.spec.md
---

## Context

See `proposal.md` — Why. Observed state that shapes the approach:

- Public routes live in two `Route::prefix('{locale?}')->whereIn('locale', …)` groups in `routes/web.php`. Laravel cannot match a *leading* optional segment, so `/about` is tried as `locale=about`, fails the `whereIn`, and 404s; only `/` matches. All generated links are already prefixed because `SetLocale` calls `URL::defaults(['locale' => …])`.
- `SetLocale` (in the `web` group) resolves route → session → `Accept-Language` → default. Middleware only runs for matched routes, so unmatched URLs currently bypass locale resolution and hit the framework's default error page.
- `ContentServiceProvider::boot()` `View::share()`s all layout data on every request, so any view extending `layouts.main` (including an `errors/404` view) gets header/footer data for free.
- `lang/{en,uk,pl}/site.php` are in parity (20 keys). There is no CMS-side translation yet (Phase 2 of `2026-09-localization-filament`), so localized copy must stay in dictionaries.
- The theme JS (`public/js/script.js`) intercepts any form with class `rd-mailform` and expects the RD Mailform JSON contract; the contact form already opted out of it, the subscribe form did not.
- `tests/Feature/ExampleTest.php` establishes the fixture pattern for public pages: seed header/footer bar content, insert widget categories with explicit IDs, then re-boot `ContentServiceProvider`. It also asserts the switcher markup (`<div class="site-language-control">`, `aria-label="Мова"`).
- The Chrome extension could not render `localhost` during the audit; verification was done with `curl` against the running Sail stack. Visual checks (mobile switcher placement) remain to be done by hand or with the `run` skill during apply.

## Goals / Non-Goals

**Goals:**
- Make every legacy unprefixed public URL land on a page (one mechanism, no duplicated route table).
- One branded 404 for all "not found" paths — unmatched routes and missing content — rendered in the resolved locale.
- Fix the contact/subscribe feedback loop with the smallest change to the existing controllers; keep the Zoho push and `RecaptchaRule` contract untouched.
- Move every hard-coded public UI string into `site.php` for all three locales.
- Baseline accessibility for the public chrome without changing the theme's CSS/JS bundles.
- Cover each fix with a PHPUnit feature test following the `ExampleTest` fixture pattern.

**Non-Goals:**
- Translating database content (widgets, posts, pages) — Phase 2 of the localization change.
- Replacing or trimming the theme bundles (`core.min.js`, `style.css`, `bootstrap.min.css`), the page loader or the analytics scripts (P3 in the proposal).
- Any change to `/admin`, `/control`, `/portfolio` or the API.
- Changing the image-normalization rules in `WidgetService`/`Widget` accessors unless production data shows the same bare-filename shape (see Open Questions).

## Decisions

### D1 — Legacy unprefixed URLs: single fallback route that re-matches with the resolved locale and redirects
Register one `Route::fallback()` (inside the `web` group, after `auth.php`). It builds the candidate path `/{app()->getLocale()}/{request path}`, asks the router whether that path matches a **GET** route in `config('locales.route_names')`, and if so issues a **302** redirect to it (query string preserved). Otherwise it `abort(404)`s, which now renders the branded 404 (D2) with the locale already resolved because the fallback route runs through `SetLocale`.

- Why 302 and not 301: the target depends on the visitor's session/`Accept-Language`, so it is not a permanent, cacheable mapping. `canonical`/`hreflang` on the destination already tell search engines the permanent URLs.
- Why redirect and not serve in place: serving unprefixed pages would create a fourth URL variant per page (unprefixed + three locales) with the canonical pointing elsewhere, and the switcher/`URL::defaults` would still generate prefixed links — the visitor would be silently moved to prefixed URLs on the next click anyway.
- Alternatives rejected: (a) registering every public route twice (prefixed + unprefixed with distinct names) — doubles the route table and every `route()` call would need to know which name to use; (b) a global middleware rewriting the path before routing — hides the redirect from the browser so the address bar keeps the legacy URL and relative asset paths keep breaking.
- Non-public paths are unaffected: `/admin/*`, `/control/*`, `/api/*`, `/login`, `/dashboard` all match real routes before the fallback; POST routes (`contact.save`, `subscriber-save`) are excluded from re-matching because a redirect would drop the body.

### D2 — Branded 404 via `resources/views/errors/404.blade.php`
Create `errors/404.blade.php` extending `layouts.main` with the copy from `errors/page-not-found.blade.php` moved to dictionary keys (`site.not_found_title`, `site.not_found_heading`, `site.not_found_text`, `site.go_home`, `site.go_blog`). Make `errors/page-not-found.blade.php` and `errors/nothin-found.blade.php` thin views that `@include` the same partial so the controllers that already return `response()->view('errors.page-not-found')->setStatusCode(404)` need no change. Fix the wrong title/heading ("DigiSpace | About" / "Pages") as part of the move.

Alternative considered: registering a custom renderable in `bootstrap/app.php` — unnecessary; Laravel picks `errors/404.blade.php` automatically, and with D1 the locale is already set.

### D3 — Footer bottom-bar links: normalise stored hrefs at render time
`footer_bottom_bar_contents` stores `/faq`, `/support`, `/privacy-policy` as free text. Add `Locales::localizeUrl(string $href): string` in `app/Support/Locales.php` that leaves absolute/external URLs untouched and prefixes site-relative paths with the current locale when the path (without prefix) matches a localized route. Use it in `footer-bottom-bar-content.blade.php`. The D1 redirect remains as a safety net, but normal clicks should not pay for a redirect.

### D4 — Contact form: `old()` + per-field `@error`, controller flash through `__()`
- Template: `value="{{ old('first_name') }}"` etc., `@error('field')` blocks per field, correct `for`/`id` pairs, `required`, `autocomplete`, `type="tel"`, labels/heading/button via `__('site.contact_*')`.
- Controller: `back()->with('success', __('site.contact_success'))`. Validation stays in `ContactSaveRequest`; `RecaptchaRule` untouched. Tests fake the verification call with `Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => true])])` and fake the Zoho push by binding/mocking the method boundary that already exists (`ContactController::sentLeadToZoho`) — if that proves awkward, the test asserts on the validation-failure path (no Zoho call) plus a separate success test that tolerates the logged Zoho error.

### D5 — Subscribe form: full-page POST with a named error bag
Remove the `rd-mailform`/`data-form-*` attributes so the theme JS no longer intercepts the form. `SubscriberController::save` validates with `validateWithBag('subscribe', …)` and flashes `subscribe_success` (localized). The footer renders `@error('email', 'subscribe')`, `old('email')` and the flash. The named bag prevents the contact form's `email` error from appearing in the footer on `/contact-us` (both forms share the page).

Alternative considered: keeping the AJAX handler and returning the RD Mailform JSON — ties a Laravel controller to an undocumented theme contract and still leaves the no-JS path broken.

### D6 — Localized chrome stays in `lang/*/site.php`
Add keys for breadcrumbs, section headings, buttons, form labels, 404 copy and the two hero slides (`site.hero.first.title|text|cta`, `site.hero.second.*`). Keep `pl` and `uk` complete — a unit test compares key sets across the three files so parity cannot drift again. Hero copy stays in Blade because CMS translation storage does not exist yet; when Phase 2 lands, the keys can be replaced by CMS fields without touching routing or tests beyond the assertion strings.

### D7 — Language switcher: `<details>` dropdown of links, endonyms, one place on every layout
Initially planned as "keep the `<select>` + `<noscript>` links"; replaced during apply after a best-practice review (NN/g language selectors, W3C i18n, WCAG 3.2.2 On Input): a `<select onchange>` changes context on input, its options are not links, and short codes (`UA`) are ambiguous. Now a `<details>/<summary>` control (works without JS) showing the current language as an endonym from `config('locales.labels')` (short code from `short_labels` on the mobile bar), with a list of `<a hreflang lang>` links, current one `aria-current`; a few lines of inline JS close the menu on outside click / Escape. Placement: desktop copy inside `.rd-navbar-element` (main nav row, survives the stuck state), mobile copy in `.rd-navbar-panel` (fixed top bar); CSS in `public/css/site.css` toggles them by layout class. The theme's phantom mobile contacts toggle is hidden on the static layout (`.rd-navbar-static--hidden` had no rule).

### D8 — Accessibility: small Blade component for social/icon links, alt text from titles
Add `App\View\Components\SocialLink` (`href`, `icon`, optional `label`) that derives the network name from the Font Awesome class (`fa-facebook` → "Facebook", …) via a map in the component, outputs `aria-label`, `target="_blank" rel="noopener"`. Use it in `header-navbar-content`, `footer` and `about`. Add `aria-label="{{ __('site.toggle_navigation') }}"`/`__('site.search')` to the two toggles and the search submit. Logo `alt="{{ config('app.name') }}"`; widget/client/technology images `alt="{{ $widget->title }}"`. Remove the stray `;` and the `<div id="app">` leftover.

### D9 — Header search targets the service search route
Point the `rd-search` form at `route('service-search')` with `name="search"` (matching `ServiceController::search`) and localize the label; verify the theme's live-search JS degrades gracefully when its `data-search-live` endpoint is absent — if it emits console errors, drop the `data-search-live` attribute.

### D10 — Tests
Extract the `ExampleTest` fixture into `tests/Feature/Concerns/SeedsPublicSite.php` (trait) so the new tests (`LegacyUrlRedirectTest`, `NotFoundPageTest`, `ContactFormFeedbackTest`, `SubscribeFormFeedbackTest`, `LocalizedChromeTest`, `PublicAccessibilityTest`) share it. They use `RefreshDatabase` on the `testing` MySQL database per `docs/testing.md`; never run against the dev DB. Assertions are on rendered markup (`assertSee(…, false)`), not on theme behaviour.

## Conflicts with existing specs

- `openspec/specs/architecture/localization.spec.md` — "Existing unprefixed URLs remain reachable through a tested compatibility route or redirect." The running branch violates this; `2026-09-localization-filament/tasks.md` marks the Phase 1 item as done. This change implements the requirement (D1) and adds the missing test; it does **not** modify the requirement. The localization change's task list should reference this change instead of re-implementing.

## Risks / Trade-offs

- [Fallback route swallows typos for non-public areas, e.g. `/admn`] → the fallback only redirects when the prefixed path matches a route in `config('locales.route_names')`; everything else is a branded 404 as before.
- [302 loops if the resolved locale segment is itself unmatched] → the re-match is done against the router before redirecting; a failed match aborts 404, never redirects.
- [`RecaptchaRule` and Zoho make the contact success path hard to test] → `Http::fake()` for reCAPTCHA; the Zoho call already catches structured API errors — the success test only asserts on the flash and the `contact_forms` row, and the validation-failure tests never reach Zoho.
- [Moving switcher CSS to `public/css/site.css` adds one request] → negligible next to the 1.3 MB theme; keeps Blade free of `<style>` and lets the mobile rules be reviewed in one place.
- [Dictionary growth in three files can drift] → parity unit test (D6).
- [Existing `ExampleTest` assertions on switcher markup] → keep the wrapper class and `aria-label` text; update the test only if the markup intentionally changes.
- [Client logo 404s could be a local-data artefact] → see Open Questions; no normalization change without production evidence.

## Migration Plan

No schema changes. Deploy as a normal release via the existing workflow. Rollback = redeploy previous release. After release: spot-check `/about`, `/blog/<slug>`, `/faq` (expect 302 → prefixed 200), `/nope` (branded 404), contact form failure/success, footer subscribe, and the mobile switcher on a real phone.

## Open Questions

- Do production `widgets.widget_image` rows for the "Our Clients" category hold bare filenames (as locally: `/1687119194.png`) or full MinIO URLs? If bare, extend the widget image fallback per `docs/content-model.md` in a follow-up; if full URLs, nothing to do. Deferrable — does not affect the specs or the other tasks.
- Should the visible short code for `uk` stay `UA` (current) or become `UK`? Configurable via `short_labels`; product decision, no impact on structure.
