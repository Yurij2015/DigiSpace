---
type: Implementation Plan
title: "Tasks — localization and parallel Filament administration"
description: "Gated implementation checklist for the proposed change."
tags: [tasks, rollout, testing]
status: in-progress
last_verified_at: 2026-09-14
---

## Phase 0 — inventory and compatibility (must pass before coding)

- [x] Resolve the current PHP runtime (Sail is configured for PHP 8.3) and all direct package versions in the lockfile.
- [x] Upgrade Laravel in isolated steps 11 → 12 → 13, following each official upgrade guide; keep tests and the production build green after each major.
- [x] Execute the Inertia v1 → v2 and Ziggy compatibility upgrade; keep legacy Vue `/admin` behavior green.
- [x] Check PHPUnit, Carbon, Sanctum, Inertia, Sentry, database drivers, queue/cache and deployment image compatibility after the upgrade.
- [x] Record the current Tailwind/Vite visual baseline for public pages and legacy `/admin` screens.
- [x] Upgrade Tailwind 3 → 4 and verify the forms plugin, VueNotus CSS and browser build.
- [x] Run the Filament 5 compatibility spike; verify Livewire 4, Tailwind 4 and existing Vite output.
- [ ] Enumerate public routes, Blade consumers, CMS tables, relationships, slugs, media disks and seeders.
- [ ] Confirm the canonical public code (`uk` or literal `ua`) and fallback policy; document the decision.
- [ ] Define the first Filament resource set, panel path (`/control`), operator allowlist/permission and ownership boundaries.
- [ ] Record a baseline: existing `/admin`, public routes, PHPUnit suite, Vite build and deployment artifact.

## Phase 1 — locale foundation

- [x] Add configured supported locales and a single resolver middleware before shared content loading.
- [x] Add initial `en`, `uk`, `pl` PHP dictionaries with identical UI keys; map legacy portfolio `ua` to `uk` at the boundary.
- [x] Add locale URL helpers, canonical/hreflang SEO links, language switcher and fallback tests; preserve existing unprefixed URLs.

## Phase 2 — content translations

- [ ] Create translation tables and constraints from the Phase 0 inventory.
- [ ] Backfill existing scalar values into the canonical locale; generate a missing-translation report.
- [ ] Update repositories/services and `ContentServiceProvider` to request the resolved locale with fallback.
- [ ] Update Blade components and SEO/sitemap generation; add slug uniqueness and `hreflang` tests.

## Phase 3 — Filament shell and read-only verification

- [ ] Install the pinned Filament version and register only the separate panel provider/path.
- [ ] Implement panel authorization and login smoke tests; verify `/admin` routes and assets are unchanged.
- [ ] Add read-only resources and a dashboard health view for the selected entities.

## Phase 4 — guarded editing

- [ ] Add policy-backed CRUD one resource at a time, beginning with Pages and Widgets.
- [ ] Add locale-grouped forms, translated slugs/SEO, media upload validation and audit logging.
- [ ] Keep destructive actions disabled until ownership and rollback are verified.

## Phase 5 — rollout

- [ ] Deploy to test with migrations and a reversible release; run smoke checks for all three locales, `/control`, `/admin` and uploads.
- [ ] Compare rendered content and SEO output against baseline; fix regressions before promotion.
- [ ] Promote to production only after the test release passes and document rollback commands.

## Verification checklist per phase

- Framework upgrade checks include `composer validate`, lockfile review, full PHPUnit, static analysis where configured, Vite production build, `php artisan about`, route/config/view cache and a test deployment artifact.
- Tailwind checks include a clean `npm ci`, production Vite build, class scan of Blade/Vue templates, visual smoke checks for public pages and legacy `/admin`, and supported-browser verification.
- PHPUnit feature tests for locale resolution, fallback, translation constraints, authorization and legacy route compatibility.
- Browser smoke tests for public locale switching, canonical/hreflang, `/control` login/resources and unchanged `/admin`.
- `php artisan route:list`, `php artisan config:cache`, `php artisan view:cache`, Vite production build and deployment artifact checks.
- `git diff --check`, migration rollback rehearsal and a documented data backup before each schema phase.

## Anti-pattern guards

- Do not replace `/admin` or redirect it to Filament during this change.
- Do not store rich translations in unvalidated JSON solely to avoid a migration.
- Do not authorize the new panel by “any authenticated user”.
- Do not run a translation backfill without a report and rollback/backup plan.
- Do not install an unpinned Filament major or a language-switcher plugin without the compatibility gate.
- Do not mix a Laravel major upgrade with content migrations or a production rollout; each framework major must be independently deployable and reversible.
