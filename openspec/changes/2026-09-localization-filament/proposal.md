---
type: Change Proposal
title: "Proposal — localized public site and parallel Filament panel"
description: "Introduce a shared locale layer and a new admin surface without breaking the existing admin."
tags: [proposal, localization, filament]
status: proposed
last_verified_at: 2026-09-13
sources:
  - id: architecture
    resource: repo://docs/architecture.md
  - id: content-model
    resource: repo://docs/content-model.md
  - id: legacy-admin
    resource: repo://app/Http/Controllers/Admin/AdminController.php
  - id: composer
    resource: repo://composer.json
---

## Problem

The public Blade site has no request locale layer and most CMS content is stored in one language. The existing Inertia/Vue admin is already large and is used in production. Replacing it while adding translations would combine two high-risk migrations.

## Decision

First bring the framework and dependency baseline forward in an isolated upgrade branch, then add a shared locale/content-translation layer, and finally add Filament as an additive panel on a separate path (recommended `/control`). Keep `/admin`, its routes, controllers and pages intact until the new panel has reached feature parity for an explicitly selected resource set.

The public language set is English, Polish and Ukrainian. Use the standards-based `uk` for new UI and URLs; keep the existing database value `ua` as a compatibility alias for portfolio records and map it at the boundary. If product URLs must literally use `/ua`, support it as an alias that resolves to `uk` without creating a second translation.

## Scope

- locale resolution, fallback and localized public URLs;
- staged Laravel 11 → 12 → 13 and PHP/runtime compatibility upgrade;
- translation storage for CMS entities, localized slugs and SEO metadata;
- migration of existing scalar content into the default locale;
- locale-aware content loading in `ContentServiceProvider` and Blade views;
- a separate Filament 5 panel, after a compatibility spike;
- read-only resources first, then guarded CRUD and translation editing;
- authorization, auditability, tests, deployment and rollback documentation.

## Non-goals

- deleting or rewriting the current `/admin` panel;
- translating historical portfolio data by guessing missing text;
- enabling every CMS resource in Filament in the first release;
- adding a community language-switcher plugin before its compatibility and security review;
- changing production deployment configuration as part of the plan phase.

## Success criteria

Visitors can select one of the three supported languages, receive translated content with a documented fallback, and get stable locale-aware canonical/hreflang URLs. An authorized operator can inspect and progressively edit content in Filament while the existing `/admin` continues to work unchanged. Every phase has automated tests and a reversible deployment step.
