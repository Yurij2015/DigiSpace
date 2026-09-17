---
type: Change Proposal
title: "Proposal — public site UX/UI audit and P1/P2 fixes"
description: "Audit of the Blade public site after the Laravel 13 / Tailwind 4 / localization work, with the highest-impact UX, navigation, form and accessibility defects fixed in the same change."
tags: [proposal, public-site, ux, ui, accessibility, localization]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: layout
    resource: repo://resources/views/layouts/main.blade.php
  - id: header
    resource: repo://resources/views/components/header.blade.php
  - id: language-switcher
    resource: repo://resources/views/components/language-switcher.blade.php
  - id: contact-form
    resource: repo://resources/views/components/contact-form.blade.php
  - id: footer
    resource: repo://resources/views/components/footer.blade.php
  - id: home
    resource: repo://resources/views/home/index.blade.php
  - id: routes
    resource: repo://routes/web.php
  - id: localization-spec
    resource: repo://openspec/specs/architecture/localization.spec.md
---

## Why

The `chore/upgrade-tailwind-vite` branch rewired the public Blade site (Laravel 13, Tailwind 4 toolchain, `{locale}` URL prefix, language switcher) without a UX/UI pass. A read-only audit of the running local stack (`http://localhost:8100`) and the Blade sources found user-visible regressions and long-standing defects: legacy unprefixed URLs now return an unbranded Laravel 404, the home hero and most page chrome stay in English on `/uk` and `/pl`, the contact form drops the visitor's input and hides the e-mail error, and several links/assets are dead. These are the first things a visitor or a search engine meets, so they should be fixed before the branch is released.

## What Changes

Audit findings are recorded here and turned into requirements; the P1/P2 items are implemented in this change, P3 items are documented for follow-up.

**P1 — navigation and reachability (observed on the running stack)**
- Unprefixed public URLs (`/about`, `/services`, `/blog`, `/contact-us`, `/pricing`, `/faq`, `/privacy-policy`, `/support`, `/page-not-found`, …) return HTTP 404; only `/` resolves. The optional `{locale?}` route prefix does not match a missing leading segment. This contradicts the in-flight localization spec ("existing unprefixed URLs remain reachable through a tested compatibility route or redirect") and breaks every external/bookmarked link and the footer bottom bar (`/faq`, `/support`, `/privacy-policy` are stored unprefixed in `footer_bottom_bar_contents`).
- Unknown URLs render Laravel's default error page (no `resources/views/errors/404.blade.php`); the branded `errors/page-not-found` view is only used from specific controllers, carries the title "DigiSpace | About" and the heading "Pages".
- Home slider slide 2 uses a relative `data-slide-bg="images/…"`, which resolves to `/uk/images/…` (404) under a locale prefix.

**P1 — lead-capturing forms**
- Contact form: the e-mail error label is shown only when the *phone* field has an error (`$errors->has('phone')` guard on the e-mail block); no `old()` values, so a validation failure clears every field; first-name error label points at a non-existent `contact-name` id; no `required`/`autocomplete` hints; labels and success text are hard-coded English.
- Footer subscribe form is marked `rd-mailform` (theme AJAX handler expecting the RD Mailform JSON contract) while `SubscriberController::save` returns a redirect with a session flash; the footer never renders the flash or `@error('email')`, so the visitor gets no visible confirmation or validation feedback.

**P2 — localized chrome**
- `lang/{en,uk,pl}/site.php` contain only 20 keys; breadcrumb "Home", page titles ("About", "Pricing", "Services", "Category Services", "Services Search", "Pages"), "Read More", "Pricing Plans", "Our Services", "Contact Form", "Send Message", "Subscribe", "Search…", "Categories", "Archive", "by", 404 copy and the whole home hero (H1, paragraphs, CTAs) are English on every locale.
- Language switcher renders `UA` for the `uk` locale — acceptable product choice, but it must be consistent with `config('locales.labels')`; on the mobile (`rd-navbar-fixed`) layout it is force-positioned with `position:fixed; right:104px` inline CSS injected from the component.

**P2 — dead links, stray markup and accessibility**
- Header search form posts to `search-results.html` (theme leftover) instead of `route('service-search')`/`route('blog-search')`; "Pages" top-level item and blog author links use `href="#"`; About-page social icons link to `#`.
- Stray `;` text node in `header.blade.php` inside the Services `<li>` (renders as visible text once service categories exist); leftover `<div id="app"><navbar></navbar></div>` on the home page.
- Logo `<img>` (twice) and every widget/client/technology image use `alt=""`; header/footer social links and the search toggle are icon-only anchors/buttons without an accessible name; the language `<select>` navigates on `change` with no submit fallback.
- Client logos on the home page reference bare filenames (`/1687119194.png` → 404 locally); the accessor fallback documented in `docs/content-model.md` does not cover this shape. Treat as data-dependent; verify against production data before changing normalization.

**P3 — recorded, not implemented here**
- ~1.3 MB of unminified/legacy theme assets (`style.css` 384 KB, `core.min.js` 665 KB) and a JS-dependent full-screen page loader; Facebook Pixel id duplicated as a literal in the `<noscript>` fallback; `height=device-height` in the viewport meta; Plerdy/GA/Pixel/reCAPTCHA all load on every page including 404s.

No **BREAKING** changes: all existing prefixed URLs keep working; unprefixed URLs regain their previous behaviour.

## Capabilities

### New Capabilities
- `public-site/navigation`: every public entry point (unprefixed legacy URL, footer bottom-bar links, branded 404 for unknown URLs, no dead `#`/theme-leftover links, locale-safe asset URLs) resolves to a branded page.
- `public-site/lead-forms`: contact and subscribe forms preserve input on validation failure, show each field's own error, give visible success feedback and use localized labels.
- `public-site/localized-ui`: all visitor-facing UI strings in the public chrome (navigation, breadcrumbs, section headings, buttons, form labels, 404 copy, home hero) come from the locale dictionaries and render in the resolved locale.
- `public-site/accessibility`: baseline accessible names for images, icon-only links/buttons and controls in the public layout; no stray text nodes in the navigation.

### Modified Capabilities
<!-- No requirement of an existing spec changes. The unprefixed-URL finding is a
     violation of the existing architecture/localization requirement, not a change to it;
     see design.md "Conflicts with existing specs". -->

## Impact

- **Views**: `resources/views/layouts/main.blade.php`, `components/header.blade.php`, `components/language-switcher.blade.php`, `components/contact-form.blade.php`, `components/footer.blade.php`, `components/footer-bottom-bar-content.blade.php`, `home/index.blade.php`, `errors/*.blade.php` (+ new `errors/404.blade.php`), breadcrumb sections of `about|blog|services|prices|contact|pages|footer-pages|promo` views, `components/blog-aside.blade.php`, `components/our-services-component.blade.php`.
- **Routing**: `routes/web.php` locale prefix groups (compatibility for unprefixed URLs), `app/Http/Middleware/SetLocale.php` only if the compatibility route needs it.
- **Controllers**: `ContactController::save`, `SubscriberController::save` (flash/validation contract only; Zoho push untouched).
- **Translations**: `lang/en|uk|pl/site.php` gain the keys listed above; no database schema change. Hero copy stays in Blade + dictionaries (translated CMS content is Phase 2 of `2026-09-localization-filament` and out of scope here).
- **Tests**: new PHPUnit feature tests for unprefixed URL compatibility, branded 404, contact form validation feedback (`old()` + per-field errors), subscribe feedback, and locale-rendered chrome. They need MySQL (`BlogRepository`) and explicit widget-category IDs per `docs/testing.md`.
- **Overlap**: the unprefixed-URL fix touches the same routing layer as the in-flight `2026-09-localization-filament` change (Phase 1, "preserve existing unprefixed URLs" is checked but not observed). Coordinate so the fix lands once.
- **Not affected**: admin (`/admin`, `/control`, `/portfolio`), API, deployment workflow, theme CSS/JS bundles.
