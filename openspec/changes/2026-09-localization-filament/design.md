---
type: Design Spec
title: "Design — localization and parallel administration"
description: "Technical decisions, boundaries and rollout gates for the proposed change."
tags: [design, architecture, localization, filament]
status: proposed
last_verified_at: 2026-09-13
sources:
  - id: service-provider
    resource: repo://app/Providers/ContentServiceProvider.php
  - id: public-layout
    resource: repo://resources/views/layouts/main.blade.php
  - id: admin-routes
    resource: repo://routes/web.php
  - id: portfolio-locale-models
    resource: repo://app/Models
---

## Framework and compatibility spike (mandatory gate)

The repository is currently Laravel 11.46.0 with a Sail PHP 8.3 runtime and a permissive `laravel/framework: ^11.0` constraint. Upgrade the framework in its own branch, following the official 11→12 and 12→13 guides, and keep each major upgrade green before continuing. Laravel 13 requires PHP 8.3+ and is the preferred target because it is the currently supported line with first-party AI-oriented primitives. Verify every direct package, PHPUnit version, Carbon behavior, queue/cache integration and deployment image before accepting the upgrade. “Better AI packages” is not a reason to upgrade blindly: choose the AI package/API separately after the framework baseline is stable.

The frontend currently uses Tailwind `^3.1.0`, PostCSS and `@tailwind` directives in `resources/css/app.css`. Upgrade Tailwind in its own frontend step after the Laravel/Vite baseline: v4 uses `@import "tailwindcss"`, recommends `@tailwindcss/vite`, does not auto-detect a JavaScript config, and has modern browser requirements. Preserve the existing Vue/Inertia visual baseline with screenshot or route smoke checks, and explicitly review the `@tailwindcss/forms` plugin and the legacy VueNotus stylesheet.

After the framework and Tailwind upgrades, pin and install a Filament major supported by the resolved Laravel/Livewire/Tailwind versions. Filament 5 currently requires PHP 8.2+, Laravel 11.28+, Livewire 4 and Tailwind 4. This repository currently has no Filament or Livewire panel, so verify the generated provider, asset build and existing Vite/Tailwind integration in an isolated branch.

Filament must use a path other than `/admin` (recommended `/control`) and a dedicated provider. Do not enable the generated default `/admin` panel. Register the provider using the Laravel 11 mechanism present in the installed application.

## Locale layer

Resolve locale before `ContentServiceProvider` reads shared header/footer/menu data. Accept a configured list (`en`, `uk`, `pl`), reject unsupported values, and fall back predictably (`uk` → `en`, unless product chooses another default). Keep locale choice in URL for public pages; preserve existing unprefixed URLs through redirects or a documented compatibility route.

Use translation tables for CMS records whose title/body/slug/SEO must be queried and edited independently. Keep stable identity, publication state, media and relationships on the base record. Enforce one slug per entity and locale. Portfolio’s existing `ua`/`pl`/`en` structures are adapted behind a locale accessor rather than copied into a third pattern. Do not use JSON for rich CMS fields merely to avoid migrations.

The first migration batch should cover the entities rendered by the public layout and highest-value pages (`pages`, `posts`, `services`/categories, `products`, `widgets`, menus and SEO fields). Inventory exact columns and relationships before writing migrations. Seed existing values into the selected canonical locale and produce a report for missing translations.

## Filament boundary

Start with read-only resources for Page, Post, Service, Product, Category and Widget. Add CRUD only after policies, validation, media storage and optimistic/concurrent edit behavior are verified. Translation forms should group fields by locale and show fallback status; slugs and SEO metadata are edited per locale. Use explicit panel authorization (`canAccessPanel`/policy or an allowlist) because the current User model has no role system.

The old admin remains the source of truth during staged rollout. Each resource gets a documented ownership boundary and a migration flag. Avoid registering the same destructive action in both panels until the team agrees which panel owns it.

## SEO and operations

Generate canonical and `hreflang` links from the resolved locale and translated slug. Add sitemap coverage and 404/redirect tests. Keep deployment additive: install dependencies in a tested release, run migrations before switching `current`, and retain a rollback path for both code and schema.
