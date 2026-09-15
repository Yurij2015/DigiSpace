---
type: Change Proposal
title: "Proposal — translatable site structure (menus, widgets, footer) with seeded uk/pl content"
description: "Extend the translations model from posts/pages to the structural CMS entities that build every public page — menus, menu items, widgets, widget categories, footer links and header/footer bars — and ship seeders that give a fresh install (and existing databases) the Ukrainian and Polish structure."
tags: [proposal, localization, cms, seeders, widgets, menus]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: translations-migration
    resource: repo://database/migrations/2026_09_14_000001_add_translations_to_cms_content.php
  - id: localized-content
    resource: repo://app/Models/Concerns/HasLocalizedContent.php
  - id: header
    resource: repo://resources/views/components/header.blade.php
  - id: footer
    resource: repo://resources/views/components/footer.blade.php
  - id: widget-seeder
    resource: repo://database/seeders/WidgetSeeder.php
  - id: menu-item-seeder
    resource: repo://database/seeders/MenuItemSeeder.php
  - id: local-dev-seeder
    resource: repo://database/seeders/LocalDevelopmentSeeder.php
  - id: content-model-docs
    resource: repo://docs/content-model.md
---

## Why

The locale layer covers the UI chrome (dictionaries) and six content tables (`posts`, `pages`, `categories`, `services`, `service_categories`, `products` have a `translations` JSON), but everything that *structures* a public page still comes from the database in English only: the "Pages" mega-menu labels (`menus.title`, `menu_items.name`), every widget on the home/about pages and in the footer (`widgets.title/subtitle/content`, `widget_categories.name/description` used as section headings), footer useful links and the header/footer bar captions. A visitor on `/uk` therefore sees a Ukrainian navbar and a fully English home page. The seeders also carry no translations at all, so a fresh install (`LocalDevelopmentSeeder`) or a new environment cannot reproduce a localized structure.

## What Changes

- **Translatable structure**: add the same `translations` JSON column and `HasLocalizedContent` accessors to `menus` (`title`), `menu_items` (`name`), `widgets` (`title`, `subtitle`, `content`), `widget_categories` (`name`, `title`, `description`), `footer_useful_links` (`name`), `header_nav_bar_contents` (`first_col_name`, `second_col_name`, `first_col_href_content`), `footer_bottom_bar_contents` (`privacy_policy_title`, `faq`, `support`). Public views keep reading the same attributes, so they render in the resolved locale with the documented fallback (`locale` → `en` → raw).
- **Slot lookups become locale-safe**: the footer selects widgets by `title === 'Phone' | 'Subscribe' | 'About us' | 'Latest news' | 'Useful Links'`; those comparisons switch to a stable slot key (`widgets.element_id`, already a column, seeded for the five footer widgets) with a raw-title fallback so existing databases keep working before the seeder runs.
- **Seeded translations (fresh installs)**: `WidgetCategorySeeder`, `WidgetSeeder`, `MenuSeeder`, `MenuItemSeeder`, `FooterUsefulLinkSeeder`, `HeaderNavBarContentSeeder`, `FooterBottomBarContentSeeder`, plus the already-translatable `PageSeeder`, `CategorySeeder`, `ServiceSeeder`, `ProductSeeder`, `PostSeeder` gain `uk`/`pl` values for every seeded row; the seed data moves out of 700-line PHP arrays into per-entity JSON files under `database/seeders/data/` (one file, three languages side by side) so translators can edit them without touching PHP.
- **Translations for populated databases**: a new idempotent `StructureTranslationsSeeder` matches existing rows by their stable identity (slug, `element_id`, category id + raw title, link URL) and fills **only missing** `translations` entries from the same JSON files — never overwriting a translation an editor already made. It is safe on testing/production and is wired into `after-deploy.sh` as an explicit, once-per-release opt-in (`DEPLOY_AFTER_HOOKS`), not run automatically.
- **Admin editing**: the Filament resources for Menus, Menu items, Widgets, Widget categories, Footer links, Header bar and Footer bar get the same English / Українська / Polski tabs as Posts and Pages, and their Edit pages use the raw-fill trait from `filament-content-editing`.
- **Widget content editor**: `widgets.content` uses the shared `ContentEditor` (rich editor, MinIO images) from `filament-content-editing` instead of a `Textarea`.
- **Kept**: category IDs and `config/constants.php` magic numbers, the `page_widget` pivot, `MenuItem → Page` resolution, `UserSeeder` behaviour, `LocalDevelopmentSeeder` guards.

No **BREAKING** changes for visitors. For developers: seed data files replace the inline arrays (same rows, same IDs when `fixedIds` is used).

## Capabilities

### New Capabilities
- `public-site/localized-structure`: navigation, widgets, section headings and footer content render in the resolved locale with fallback; slot lookups do not depend on the display language.
- `architecture/seed-translations`: what the seeders must provide (three-language structure for a fresh install) and how translations are added to an existing database without overwriting editor changes.
- `admin/structure-translations`: structural resources are editable per language in the control panel, with the same translation-safety guarantee as posts and pages.

### Modified Capabilities
<!-- `architecture/localization` (openspec/specs/architecture/localization.spec.md) already states "every translatable
     CMS field has at most one value per entity and locale"; this change extends the set of translatable fields,
     it does not change that requirement. The spec file is not in delta format. -->

## Impact

- **Migrations**: one migration adding nullable `translations` JSON to the seven structural tables (same shape as `2026_09_14_000001`).
- **Models**: `Menu`, `MenuItem`, `Widget`, `WidgetCategory`, `FooterUsefulLink`, `HeaderNavBarContent`, `FooterBottomBarContent` gain `HasLocalizedContent` + `translations` cast/fillable; `Widget` also exposes `slot` (=`element_id`) for the footer.
- **Views**: `components/footer.blade.php` slot matching; no other template change (accessors do the work). `ContentServiceProvider` unchanged.
- **Seeders**: rewritten to read `database/seeders/data/*.json`; new `StructureTranslationsSeeder`; `LocalDevelopmentSeeder` order unchanged; `DatabaseSeeder` unchanged in behaviour.
- **Filament**: 7 resources gain translation tabs; depends on `filament-content-editing` (raw-fill trait, `ContentEditor`) — implement after it or cherry-pick those two helpers first.
- **Tests**: public rendering of `/uk` and `/pl` structure with seeded translations; fallback when a translation is missing; footer slot resolution with a translated title; seeder idempotency (run twice, editor-changed translation preserved); Filament raw-fill for a widget.
- **Docs**: `docs/content-model.md` (translations on structure, slot keys, seed data files), `docs/local-setup.md` (seeding), `docs/deployment/README.md` (running `StructureTranslationsSeeder` via `DEPLOY_AFTER_HOOKS`).
- **Deploy**: migration runs with the release; the translation seeder is opt-in per environment.
