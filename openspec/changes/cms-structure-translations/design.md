---
type: Design
title: "Design — translatable site structure and seeded translations"
description: "Reuse the translations JSON + HasLocalizedContent pattern on seven structural tables, move seed data to JSON files with three languages, add an idempotent translation seeder, and make footer slot lookups key-based."
tags: [design, localization, seeders, widgets, menus]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: translations-migration
    resource: repo://database/migrations/2026_09_14_000001_add_translations_to_cms_content.php
  - id: localized-content
    resource: repo://app/Models/Concerns/HasLocalizedContent.php
  - id: footer
    resource: repo://resources/views/components/footer.blade.php
  - id: widget-model
    resource: repo://app/Models/Widget.php
  - id: widget-category-seeder
    resource: repo://database/seeders/WidgetCategorySeeder.php
  - id: local-dev-seeder
    resource: repo://database/seeders/LocalDevelopmentSeeder.php
  - id: content-model-docs
    resource: repo://docs/content-model.md
---

## Context

See `proposal.md` — Why. Observed state that shapes the approach:

- Translation pattern in place: `translations` JSON column (`2026_09_14_000001`), `HasLocalizedContent::localizedAttribute('field')` accessors resolving `locale → en → raw`, Filament forms writing `translations.{uk,pl}.field`. Six tables use it.
- Structural tables and their translatable columns: `menus.title`; `menu_items.name` (+ `slug`, `href`, `location` non-translatable); `widgets.title`, `subtitle`, `content` (+ `icon`, `widget_image`, `css_class`, `anchor`, `element_id`); `widget_categories.name`, `title`, `description`; `footer_useful_links.name` (+ `url`, `status`); `header_nav_bar_contents.first_col_name`, `second_col_name`, `first_col_href_content`; `footer_bottom_bar_contents.privacy_policy_title`, `faq`, `support`, `company_name`.
- `footer.blade.php` selects widgets with `$widget->title === 'Phone' | 'Subscribe' | 'About us' | 'Latest news' | 'Useful Links'` — would break once `title` is localized. `widgets.element_id` exists and is unused for these rows.
- `ContentServiceProvider` shares `footerWidgets`, `pageSubmenu*` (menus with items), `headerNavBarContent`, `footerBottomBarContent`, `footerUsefulLinks`, `serviceCategories` on every view; views read `->title`, `->name`, … so accessors localize them with no template change.
- Seeders: inline PHP arrays (`WidgetSeeder` 697 lines / 52 rows, `MenuItemSeeder` 203 lines / 23 rows, `WidgetCategorySeeder` with `fixedIds`), `PageSeeder` rows are slug-only skeletons, `PostSeeder` uses fixed `category_id`/`user_id`. `LocalDevelopmentSeeder` guards (local env, empty DB, relocates the migration-created image category to id 16) and calls the seeders in a fixed order. `DatabaseSeeder` is the same list without the guards.
- `filament-content-editing` (planned) introduces `FillsRawTranslatableFields` and `ContentEditor`; this change reuses both.
- Widget/post images are absolute MinIO URLs; `ContentImage::make('widget_image','s3','widgets',true)` exists in `WidgetForm`.

## Goals / Non-Goals

**Goals:**
- Same storage/accessor/form pattern everywhere — no second translation mechanism.
- Seed data readable and editable by a translator (JSON, three languages side by side), and the only source for both fresh installs and the populated-DB seeder.
- Populated databases (testing, production) gain translations safely and repeatably.

**Non-Goals:**
- Translating `settings`, `widget_icons.description`, portfolio tables, or `services.image_alt`.
- Localized slugs for menu items (`/uk/pages/{slug}` keeps the English slug — consistent with pages today).
- A translation-management UI beyond the existing tabs (no missing-translation dashboard).
- Changing widget category IDs or the `page_widget` attachment model.

## Decisions

### D1 — One migration, same shape as the content one
`2026_09_xx_add_translations_to_cms_structure.php`: `json('translations')->nullable()->after('id')` on `menus`, `menu_items`, `widgets`, `widget_categories`, `footer_useful_links`, `header_nav_bar_contents`, `footer_bottom_bar_contents`; `down()` drops them. Models: add `HasLocalizedContent`, `'translations' => 'array'` cast, fillable, and one `localizedAttribute()` accessor per translatable column listed in Context. `company_name` stays untranslated (brand).

### D2 — Footer slots by `element_id`, raw-title fallback
`Widget::slot()` accessor returns `element_id ?: Str::slug(getRawOriginal('title'))`. Footer compares `$widget->slot === 'footer-phone' | 'footer-subscribe' | 'footer-about' | 'footer-latest-news' | 'footer-useful-links'` **or** the legacy raw title (`getRawOriginal('title') === 'Phone'`, …) so an un-seeded production footer keeps working; the seeders set `element_id` for the five footer widgets and the populated-DB seeder backfills it. Documented in `docs/content-model.md` next to the category-ID contract.

Alternative rejected: a new `slot` column — `element_id` already exists, is editable in Filament, and is empty for these rows.

### D3 — Seed data as JSON files
`database/seeders/data/{widget_categories,widgets,menus,menu_items,footer_useful_links,header_nav_bar_contents,footer_bottom_bar_contents,pages,categories,services,products,posts}.json`. Row shape: non-translatable columns at top level, translatable ones under `"i18n": {"en": {...}, "uk": {...}, "pl": {...}}`; identity fields (`id` where `fixedIds` applies, `slug`, `element_id`, `url`) explicit. A `SeedData` helper (`database/seeders/Support/SeedData.php`) loads a file, validates that every `i18n` entry has all three locales (throws with the row identity), and maps to the insert shape: base columns from `en`, `translations` = `{uk: {...}, pl: {...}}` (en is the base, not duplicated — matches how Filament writes today). Existing seeders keep their class names and `fixedIds` behaviour, they just read the JSON. `WidgetCategorySeeder` keeps IDs 1–15 with `fixedIds`.

Translations for the 52 widgets / 23 menu items / 15 categories / footer rows are authored in this change (uk and pl), reviewed by the user before merge; obvious placeholder rows (Vue Notus demo texts in the landing categories 1–6) are translated literally, not rewritten.

### D4 — `StructureTranslationsSeeder` for populated databases
Reads the same JSON files; for each table resolves the identity (`widget_categories`: `id`; `widgets`: `element_id` else `widget_category_id` + raw `title`; `menus`: `id`; `menu_items`: `slug`; `footer_useful_links`: `url`; bars: single row; `pages`/`categories`/`services`/`products`/`posts`: `slug`), merges `translations` with **existing values winning** (`array_replace_recursive($seed, $existing)`), sets `element_id` for footer widgets when empty, and prints a summary (`updated / unchanged / unmatched` per table). Never touches base columns. Registered in neither `DatabaseSeeder` nor `LocalDevelopmentSeeder` (fresh installs get translations from D3 directly); run on servers via `DEPLOY_AFTER_HOOKS` once, or by hand: `php artisan db:seed --class=StructureTranslationsSeeder --force`.

### D5 — Filament tabs and editor for structural resources
Menus, MenuItems, Widgets, WidgetCategories, FooterUsefulLinks, HeaderNavBarContents, FooterBottomBarContents forms: wrap translatable fields in the same `Tabs('translations')` (English / Українська / Polski) used by `PostForm`, non-translatable fields outside; `WidgetForm.content` → `ContentEditor::make('content', 'widgets/content')` (and `translations.{uk,pl}.content` likewise). Edit pages use `FillsRawTranslatableFields` with the per-model field lists. Tables show the localized value (panel language), which is the desired behaviour for lists.

### D6 — Tests
- `tests/Feature/LocalizedStructureTest.php`: seeds a menu/item, widget category, footer widgets (with and without `element_id`), bars with `uk` translations; asserts `/uk` renders translated labels/headings and `/pl` falls back; footer slots resolve on `/pl`.
- `tests/Unit/SeedDataTest.php`: every JSON file loads, every row has all three locales for every translatable field, identities unique (this is the "seed data completeness" gate).
- `tests/Feature/StructureTranslationsSeederTest.php`: populated DB (rows from the JSON, translations stripped, one editor-made `uk` title) → seeder fills missing, preserves the editor value, backfills `element_id`, second run reports zero updates.
- `tests/Feature/LocalDevelopmentSeederTest.php` (MySQL, `RefreshDatabase`): after the full local seed, `/uk` contains a known Ukrainian heading and widget category 12 is "Why Choose Us".
- Filament: `EditWidget` raw-fill under `pl`, editor attachment directory `widgets/content`.

## Risks / Trade-offs

- [Accessor on `widgets.title` changes what admin *tables* show] → intended (panel language); slot logic no longer depends on it (D2).
- [Seeded translations on production overwrite nothing but may add wording the owner wants different] → editor changes win on re-runs; wording is reviewed before merge; running the seeder on production is an explicit hook.
- [`translations` JSON `en` key present in some rows written by earlier Filament versions] → accessor already prefers `locale → en → raw`; `SeedData` never writes `en` into `translations`.
- [JSON seed files diverge from `config/constants.php` IDs] → `SeedDataTest` asserts the widget-category IDs and names for the constants.
- [`LocalDevelopmentSeeder` runtime grows] → negligible (same row counts).
- [Dependency on `filament-content-editing` helpers] → implement that change first, or copy `FillsRawTranslatableFields`/`ContentEditor` into this branch and reconcile on merge.

## Migration Plan

1. Merge after `filament-content-editing` (or with its helpers cherry-picked). Deploy `dev` → testing: migration adds columns; site unchanged (no translations yet, accessors fall back).
2. On testing run `StructureTranslationsSeeder` (via `DEPLOY_AFTER_HOOKS` for one deploy, then remove) → review `/uk`, `/pl`, footer, mega-menu, admin tabs.
3. `master` → production, same one-off seeder run. Rollback: previous release; the added columns are nullable and unused by old code.

## Open Questions

- `company_name` in the footer bottom bar — keep untranslated (brand) — assumed yes.
- Should `menu_items.slug` be localized later for SEO (`/uk/pages/pro-nas`)? Out of scope; the JSON shape leaves room for `i18n.uk.slug`.
