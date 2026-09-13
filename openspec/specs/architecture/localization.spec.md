---
type: Behaviour Spec
title: "Architecture — Public localization"
description: "Defines locale resolution, translated CMS content and URL behavior for English, Ukrainian and Polish."
tags: [architecture, localization, public-site]
status: proposed
last_verified_at: 2026-09-13
sources:
  - id: app-config
    resource: repo://config/app.php
  - id: content-provider
    resource: repo://app/Providers/ContentServiceProvider.php
  - id: layout
    resource: repo://resources/views/layouts/main.blade.php
  - id: portfolio
    resource: repo://app/Models
---

# OpenSpec: Architecture — Public localization

## Supported locales

The application exposes `en`, `uk` and `pl` from one configuration source. Unsupported values fall back to the configured default. Existing portfolio database values `ua` remain readable through a compatibility mapping to `uk`.

## Locale-aware content

Every translatable CMS field has at most one value per entity and locale. A missing requested translation uses the documented fallback and exposes its fallback state to the admin. Slugs are unique within an entity and locale.

## URLs and SEO

Public URLs resolve their locale before shared content is loaded. Canonical URLs and `hreflang` links contain the translated locale/slug pair. Existing unprefixed URLs remain reachable through a tested compatibility route or redirect.

## Verification

Feature tests cover supported/unsupported locales, fallback, slug collisions, legacy portfolio `ua`, canonical/hreflang output and shared menu/header/footer loading.
