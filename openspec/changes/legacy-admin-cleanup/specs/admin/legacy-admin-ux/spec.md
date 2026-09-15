---
type: Behaviour Spec
title: "Admin — Legacy Inertia/Vue UX"
description: "Defines the compatibility, navigation, interaction, and verification requirements for the existing legacy administration panel."
tags: [admin, inertia, vue, ux, compatibility]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: admin-routes
    resource: repo://routes/web.php
  - id: admin-controller
    resource: repo://app/Http/Controllers/Admin/AdminController.php
  - id: admin-pages
    resource: repo://resources/js/Pages/Admin
  - id: admin-navigation
    resource: repo://resources/js/Components/Navbars/AdminNavbar.vue

# OpenSpec: Admin — Legacy Inertia/Vue UX

## Purpose

Keep the existing Inertia/Vue administration panel reliable and coherent while the separate Filament panel evolves. Operators must be able to reach every supported legacy feature, understand its state, and complete content changes without route or locale surprises.

## ADDED Requirements

### Requirement: Legacy admin shell is consistent

The legacy admin panel SHALL render a shared shell with consistent navigation, active-link state, responsive behavior, user controls, locale control, page title, loading feedback, and error feedback across all `/admin` screens.

#### Scenario: Operator opens an admin resource

- **WHEN** an authenticated operator opens any supported legacy admin resource
- **THEN** the page renders the shared shell, identifies the current destination, and provides a working path back to the relevant admin section

#### Scenario: Operator uses a narrow viewport

- **WHEN** the panel is viewed at a mobile or tablet width
- **THEN** navigation and forms remain usable without clipped controls or inaccessible actions

### Requirement: Legacy navigation maps to working routes

Every navigation item displayed by the legacy panel SHALL resolve to an existing named route whose controller response and Vue page match the destination label. Active styling SHALL identify the current route and SHALL not mark unrelated items as active.

#### Scenario: Operator follows a menu item

- **WHEN** an operator selects a visible legacy-admin or portfolio menu item
- **THEN** the browser reaches the intended page without a 404, 403 caused by a wrong link, or route-name exception

#### Scenario: Operator opens a nested resource

- **WHEN** an operator opens a create, edit, show, or child-resource link
- **THEN** the link carries the correct route parameter and the destination loads the corresponding record or displays a documented not-found state

### Requirement: Resource forms preserve existing contracts

Legacy admin create and update forms SHALL preserve their existing HTTP methods, route names, field names, validation behavior, file-upload behavior, and response payload contracts while presenting consistent controls and errors.

#### Scenario: Valid update is submitted

- **WHEN** an operator submits a valid update for a supported resource
- **THEN** the existing endpoint persists the change and the panel displays a successful result or navigates to the documented destination

#### Scenario: Invalid input is submitted

- **WHEN** an operator submits invalid data
- **THEN** the panel remains on the form, displays field-level or form-level errors, and does not silently discard entered values

### Requirement: Legacy admin locale selection is supported

The legacy admin panel SHALL offer the configured Ukrainian, Polish, and English locales using the application locale contract, persist the selected locale for subsequent admin requests, and fall back safely when a locale is unsupported. The control SHALL use human-readable labels and SHALL not expose internal compatibility values such as `ua` as a selectable public label.

#### Scenario: Operator changes locale

- **WHEN** an authenticated operator selects Ukrainian, Polish, or English in the legacy panel
- **THEN** the next admin response uses that locale and the selected option remains reflected in the control

#### Scenario: Unsupported locale is requested

- **WHEN** a request contains an unsupported locale value
- **THEN** the application uses the configured fallback locale and does not render a broken admin page

### Requirement: Legacy admin regressions are observable

The project SHALL verify representative legacy admin routes, navigation, locale switching, validation errors, and resource mutations in automated tests or equivalent browser checks. The checks SHALL include a control that the separate `/control` panel and public localized routes remain reachable.

#### Scenario: Regression suite runs

- **WHEN** the legacy-admin verification suite is executed
- **THEN** it reports failures for broken route links, incorrect active states, locale persistence errors, failed form error rendering, or changed response contracts
