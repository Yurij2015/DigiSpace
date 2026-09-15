---
type: Behaviour Spec
title: "Admin — Structure translations"
description: "Menus, menu items, widgets, widget categories, footer links and header/footer bars are editable per language in the control panel with the same translation-safety guarantee as posts and pages."
tags: [admin, filament, localization, widgets, menus]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: widget-resource
    resource: repo://app/Filament/Resources/Widgets/WidgetResource.php
  - id: menu-item-resource
    resource: repo://app/Filament/Resources/MenuItems/MenuItemResource.php
  - id: content-editing-spec
    resource: repo://openspec/changes/filament-content-editing/specs/admin/content-editing/spec.md
---

## Purpose

Lets an editor translate the site's structure from the same panel and with the same tab layout they use for posts and pages, without risking the base-language values.

## ADDED Requirements

### Requirement: Language tabs on structural resources
The create/edit forms of Menus, Menu items, Widgets, Widget categories, Footer useful links, Header bar and Footer bottom bar MUST present English / Українська / Polski tabs for their translatable fields, in the same layout as posts and pages; non-translatable fields (slugs, hrefs, icons, category selects, images) MUST stay outside the tabs.

#### Scenario: Widget form
- **WHEN** the widget edit form is opened
- **THEN** title, subtitle and content appear in each language tab, and category, icon, image, CSS class, anchor and element id appear once outside the tabs

### Requirement: Widget content uses the visual editor
`widgets.content` MUST be edited with the same rich editor (toolbar, MinIO image upload) as post and page content.

#### Scenario: Image in a widget
- **WHEN** an editor inserts an image into a widget's Ukrainian content and saves
- **THEN** the file is stored on the `s3` disk under `widgets/content/` and the public page renders it

### Requirement: Editing a structural record never alters another locale
Opening any of these edit forms MUST fill base fields from stored base values regardless of the panel language, and saving MUST only write the locale that was edited.

#### Scenario: Panel in Polish
- **WHEN** the panel UI locale is `pl` and an editor opens a menu item with a `pl` translation
- **THEN** the English tab shows the base name, and saving without changes leaves the row identical
