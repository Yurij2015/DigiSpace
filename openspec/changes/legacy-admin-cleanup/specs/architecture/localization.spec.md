---
type: Behaviour Spec
title: "Architecture — Public localization (legacy admin delta)"
description: "Extends the locale contract to cover the legacy Inertia/Vue administration panel without changing public URL or API compatibility."
tags: [architecture, localization, admin]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: localization-spec
    resource: repo://openspec/specs/architecture/localization.spec.md
  - id: locales-config
    resource: repo://config/locales.php
  - id: locale-switcher
    resource: repo://resources/js/Components/LanguageSwitcher.vue
  - id: admin-routes
    resource: repo://routes/web.php

# OpenSpec: Architecture — Public localization (legacy admin delta)

## MODIFIED Requirements

### Requirement: Supported locales

The application SHALL expose `en`, `uk`, and `pl` from one configuration source. Unsupported values SHALL fall back to the configured default. Existing portfolio database values `ua` SHALL remain readable through a compatibility mapping to `uk`. The legacy `/admin` panel SHALL use the same supported locale set, persist the operator's selection for subsequent admin requests, and display human-readable labels rather than internal compatibility values.

#### Scenario: Legacy admin locale is selected

- **WHEN** an authenticated operator selects `uk`, `pl`, or `en` in the legacy admin panel
- **THEN** subsequent legacy admin responses use the selected locale and the control reflects the selection

#### Scenario: Unsupported admin locale is requested

- **WHEN** an admin request contains an unsupported locale
- **THEN** the configured fallback locale is used and the request does not expose an internal database locale as a user-facing option

### Requirement: URLs and SEO

Public URLs SHALL resolve their locale before shared content is loaded. Canonical URLs and `hreflang` links SHALL contain the translated locale/slug pair. Existing unprefixed URLs SHALL remain reachable through a tested compatibility route or redirect. Changes to the legacy admin locale control SHALL NOT alter public URL generation, API response shapes, or public fallback behavior.

#### Scenario: Public route is opened after an admin locale change

- **WHEN** an operator changes locale in `/admin` and then opens a public localized URL
- **THEN** the public URL, canonical link, and `hreflang` behavior remain governed by the public locale contract

