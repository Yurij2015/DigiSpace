---
type: Behaviour Spec
title: "Public site — Localized structure"
description: "Navigation, widgets, section headings and footer content render in the resolved locale with fallback; slot lookups do not depend on the display language."
tags: [public-site, localization, widgets, menus, footer]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: header
    resource: repo://resources/views/components/header.blade.php
  - id: footer
    resource: repo://resources/views/components/footer.blade.php
  - id: content-provider
    resource: repo://app/Providers/ContentServiceProvider.php
  - id: localized-content
    resource: repo://app/Models/Concerns/HasLocalizedContent.php
---

## Purpose

Makes a Ukrainian or Polish visit look Ukrainian or Polish end to end: the parts of a page that come from the database structure (menus, widgets, headings, footer) follow the resolved locale exactly like posts and pages already do.

## ADDED Requirements

### Requirement: Structural entities are translatable
`menus.title`, `menu_items.name`, `widgets.title/subtitle/content`, `widget_categories.name/title/description`, `footer_useful_links.name`, `header_nav_bar_contents.first_col_name/second_col_name/first_col_href_content` and `footer_bottom_bar_contents.privacy_policy_title/faq/support` MUST each hold at most one value per supported locale, stored alongside the base value, and MUST resolve for the current request as: requested locale → `en` → base column.

#### Scenario: Translated mega-menu
- **WHEN** a menu item has `name = "Contact us"` and `translations.uk.name = "Контакти"` and a visitor loads `/uk`
- **THEN** the header mega-menu shows "Контакти", and `/pl` (no `pl` translation) shows "Contact us"

#### Scenario: Translated widget block
- **WHEN** a "Why choose us" widget has a `uk` title and content and the category has a `uk` name
- **THEN** `/uk` renders the Ukrainian section heading, widget title and content, and `/en` renders the base values

### Requirement: Slot lookups are locale-independent
Templates that pick a specific widget for a layout slot MUST identify it by a stable key (`widgets.element_id`), falling back to the base-language title only when no key is set; the display language MUST NOT change which widget is chosen.

#### Scenario: Footer on a Polish page
- **WHEN** the footer "Subscribe" widget has `element_id = footer-subscribe` and a Polish title and a visitor loads `/pl`
- **THEN** the subscribe form renders with the Polish title in the subscribe slot

#### Scenario: Legacy row without a key
- **WHEN** a footer widget has no `element_id` and base title "Phone"
- **THEN** it is still rendered in the phone slot on every locale

### Requirement: Missing translations fall back without gaps
When a structural entity has no translation for the requested locale, the public page MUST show the English/base value; no heading, menu label or footer caption MAY render empty.

#### Scenario: Partially translated menu
- **WHEN** a menu has a `uk` title but one of its items has no `uk` name
- **THEN** `/uk` shows the Ukrainian menu title and the English item name
