---
type: Behaviour Spec
title: "Architecture — Seed translations"
description: "Seeders provide the three-language site structure for a fresh install, and translations can be added to an existing database without overwriting editor changes."
tags: [architecture, seeders, localization]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: widget-seeder
    resource: repo://database/seeders/WidgetSeeder.php
  - id: menu-item-seeder
    resource: repo://database/seeders/MenuItemSeeder.php
  - id: local-dev-seeder
    resource: repo://database/seeders/LocalDevelopmentSeeder.php
  - id: local-setup-docs
    resource: repo://docs/local-setup.md
---

## Purpose

Guarantees that every environment — a developer's fresh database, the testing site or production — can obtain the same Ukrainian and Polish structure from versioned seed data, and that re-running the seed never destroys what an editor translated by hand.

## ADDED Requirements

### Requirement: Seed data carries every supported locale
Every structural seed row (widget categories, widgets, menus, menu items, footer links, header/footer bars) and every already-translatable content seed row (pages, categories, services, products, posts) MUST provide `en`, `uk` and `pl` values for each translatable field, stored in versioned data files under `database/seeders/data/`. A fresh `LocalDevelopmentSeeder` run MUST produce a database where `/uk` and `/pl` render fully translated structure, with the category IDs from `config/constants.php` intact.

#### Scenario: Fresh local install
- **WHEN** `php artisan migrate:fresh && php artisan db:seed --class=LocalDevelopmentSeeder` runs on an empty local database
- **THEN** `/uk` shows Ukrainian menu labels, section headings and footer captions, `/pl` shows Polish ones, and widget category IDs 1–16 match the constants

#### Scenario: Seed data completeness
- **WHEN** the seed data files are validated
- **THEN** every translatable field of every row has a non-empty value for all three locales

### Requirement: Translations can be added to a populated database idempotently
A dedicated seeder MUST add translations to existing rows by matching their stable identity (slug, `element_id`, category + base title, link URL), MUST fill only locales that are missing, MUST NOT modify base columns, and MUST be safe to run any number of times.

#### Scenario: Editor's translation is preserved
- **WHEN** a widget already has `translations.uk.title = "Чому ми"` set by an editor and the seeder's data says "Чому обирають нас"
- **THEN** after running the seeder the widget still has "Чому ми" and gains the missing `pl` title

#### Scenario: Unknown rows are ignored
- **WHEN** the database contains a widget that is not in the seed data
- **THEN** the seeder leaves it untouched and reports it in its summary

#### Scenario: Run twice
- **WHEN** the seeder runs twice in a row
- **THEN** the second run changes no rows and reports zero updates
