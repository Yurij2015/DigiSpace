---
type: Implementation Plan
title: "Tasks — translatable site structure and seeded translations"
description: "Ordered, verifiable steps: schema and models, locale-safe footer slots, JSON seed data with uk/pl, idempotent seeder, Filament tabs, tests, rollout."
tags: [tasks, localization, seeders, filament]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: proposal
    resource: repo://openspec/changes/cms-structure-translations/proposal.md
  - id: design
    resource: repo://openspec/changes/cms-structure-translations/design.md
---

Depends on `filament-content-editing` helpers (`FillsRawTranslatableFields`, `ContentEditor`); implement after it or cherry-pick them first. Tests through Sail on the `testing` MySQL DB; `pint --dirty` and `phpstan` before finishing each group. Never run `LocalDevelopmentSeeder` against a populated database.

## 1. Schema and models

- [x] 1.1 Create the migration adding nullable `translations` JSON to `menus`, `menu_items`, `widgets`, `widget_categories`, `footer_useful_links`, `header_nav_bar_contents`, `footer_bottom_bar_contents` (design D1) with a `down()`; verify `migrate` and `migrate:rollback` on the local DB.
- [ ] 1.2 Add `HasLocalizedContent`, `translations` cast/fillable and `localizedAttribute()` accessors to the seven models for the columns listed in design Context; add `Widget::slot()` (design D2); verify PHPStan and that `/uk` still renders identically before any translation exists (fallback).
- [ ] 1.3 Switch `components/footer.blade.php` slot matching to `$widget->slot` with the raw-title fallback; verify the footer renders on `/`, `/uk`, `/pl` locally with the current (un-keyed) rows and `tests/Feature/SubscribeFormFeedbackTest` still passes.

## 2. Seed data as JSON

- [ ] 2.1 Create `database/seeders/Support/SeedData.php` (load, validate all three locales per translatable field, map to base + `translations`) and `tests/Unit/SeedDataTest.php` (completeness, unique identities, widget-category IDs/names match `config/constants.php`); verify the unit test runs green on an empty data set first.
- [ ] 2.2 Export the existing inline seed arrays into `database/seeders/data/*.json` (widget_categories, widgets, menus, menu_items, footer_useful_links, header_nav_bar_contents, footer_bottom_bar_contents, pages, categories, services, products, posts) with `en` values, identities (`id` for fixed-ID categories, `slug`, `element_id` for the five footer widgets, `url`); verify a fresh `LocalDevelopmentSeeder` run produces the same row counts and IDs as before (compare `SELECT COUNT(*)`/ids per table against a pre-change dump).
- [ ] 2.3 Author `uk` and `pl` values for every translatable field in the JSON files (design D3: literal translations, demo texts translated not rewritten); verify `SeedDataTest` is green and hand the files to the user for wording review before merge.
- [ ] 2.4 Rewrite the seeders to read the JSON through `SeedData`, keeping class names, `fixedIds` and the `LocalDevelopmentSeeder`/`DatabaseSeeder` order; verify `migrate:fresh` + `LocalDevelopmentSeeder` locally and that `/uk` and `/pl` show translated menu labels, section headings and footer captions (`tests/Feature/LocalDevelopmentSeederTest.php`).

## 3. Translations for populated databases

- [ ] 3.1 Create `database/seeders/StructureTranslationsSeeder.php` (design D4: identity matching per table, existing translations win, `element_id` backfill for footer widgets, summary output); verify `php artisan db:seed --class=StructureTranslationsSeeder` on the local DB prints a summary and a second run reports zero updates.
- [ ] 3.2 Write `tests/Feature/StructureTranslationsSeederTest.php` (missing translations filled, editor-made `uk` title preserved, unknown rows untouched and reported, base columns unchanged, idempotent); verify it passes.
- [ ] 3.3 Document the seeder and the slot keys in `docs/content-model.md`, seeding in `docs/local-setup.md`, and the one-off `DEPLOY_AFTER_HOOKS` invocation in `docs/deployment/README.md`; verify links and that no server paths appear.

## 4. Public rendering tests

- [ ] 4.1 Write `tests/Feature/LocalizedStructureTest.php` (design D6: translated mega-menu, widget heading/content, footer captions on `/uk`; fallback on `/pl`; footer slots with translated titles and with a legacy un-keyed row); verify it passes.

## 5. Filament

- [ ] 5.1 Add English / Українська / Polski tabs to the Menus, MenuItems, Widgets, WidgetCategories, FooterUsefulLinks, HeaderNavBarContents, FooterBottomBarContents forms (translatable fields inside, others outside), `ContentEditor` for widget content (`widgets/content`), and `FillsRawTranslatableFields` on their Edit pages (design D5); verify each form saves the expected `translations` shape and PHPStan is clean.
- [ ] 5.2 Write `tests/Feature/Filament/StructureTranslationsTest.php`: `EditWidget` under `pl` fills raw base values and saving leaves the row identical; editor attachment directory is `widgets/content`; verify it passes.

## 6. Verification and rollout

- [ ] 6.1 Full suite, Pint, PHPStan green; verify `vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit` reports 0 failures.
- [ ] 6.2 Push to `dev` → testing deploy; run `StructureTranslationsSeeder` once on testing (via `DEPLOY_AFTER_HOOKS` or SSH); verify `/uk`, `/pl`, footer, mega-menu and the admin tabs on the testing site; remove the hook.
- [ ] 6.3 Merge to `master` → production deploy; run the seeder once on production; verify the same pages and the health check; record the summary counts here.
