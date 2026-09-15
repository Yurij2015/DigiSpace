---
type: Behaviour Spec
title: "Admin — Parallel Filament panel"
description: "Defines the additive Filament panel boundary and authorization requirements."
tags: [admin, filament, authorization]
status: proposed
last_verified_at: 2026-09-13
sources:
  - id: admin-controller
    resource: repo://app/Http/Controllers/Admin/AdminController.php
  - id: admin-routes
    resource: repo://routes/web.php
  - id: user
    resource: repo://app/Models/User.php
  - id: composer
    resource: repo://composer.json
---

# OpenSpec: Admin — Parallel Filament panel

## Panel isolation

Filament is served from a dedicated path such as `/control`. Existing `/admin` routes, controllers, Inertia pages and permissions remain available and unchanged. The generated Filament default `/admin` panel is not enabled.

## Authorization

Panel access is explicitly restricted by a role/permission or a reviewed operator allowlist. Authentication alone is insufficient. Resource actions additionally pass the relevant policy and ownership checks.

## Progressive resources

The first release exposes read-only Page, Post, Service, Product, Category and Widget resources. CRUD and destructive actions are enabled per resource only after validation, media, policy, audit and rollback checks pass.

## Verification

Tests prove authorized/unauthorized panel access, resource policy behavior, `/control` route health, unchanged `/admin` route health and non-regression of public rendering.
