---
type: Implementation Plan
title: "Tasks — Filament content editing"
description: "Ordered, verifiable steps: navigation grouping first (user priority), then translation-safe forms, the editor, form layout, tables/actions, tests and rollout."
tags: [tasks, admin, filament]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: proposal
    resource: repo://openspec/changes/filament-content-editing/proposal.md
  - id: design
    resource: repo://openspec/changes/filament-content-editing/design.md
---

Run tests via Sail (`vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit …`, `testing` MySQL DB). `vendor/bin/sail bin pint --dirty --format agent` and `vendor/bin/phpstan analyse` before finishing each group. Verify the panel visually at `http://localhost:8100/control` with a `FILAMENT_ADMIN_EMAILS` user.

## 1. Navigation

- [ ] 1.1 `AdminPanelProvider::navigationGroups()` → Content / Settings (collapsed) / Portfolio (collapsed) with `NavigationGroup` objects and localized labels (`lang/{en,uk,pl}/admin.php`); verify the sidebar shows exactly three groups.
- [ ] 1.2 Set `getNavigationGroup()`/`getNavigationSort()` on all 24 resources per design D7 (remove the old group strings and duplicate `$navigationSort` properties); verify `grep -rhoE "return '[^']+';" app/Filament/Resources/*/*Resource.php` (navigation group lines) yields only the three labels and `tests/Feature/Filament/NavigationTest.php` asserts group membership and Posts first in Content.

## 2. Translation safety (bug fix first — it protects everything after)

- [ ] 2.1 Create `app/Filament/Support/FillsRawTranslatableFields.php` (design D2): `mutateFormDataBeforeFill()` replaces `static::$rawFields` and `translations` with `getRawOriginal()` values; apply to `EditPost`, `EditPage`, `EditCategory`, `EditService`, `EditServiceCategory`, `EditProduct` with the right field lists; verify by opening a translated post with the panel in `uk` — English tab shows the English name.
- [ ] 2.2 Write `tests/Feature/Filament/MakesFilamentAdmin.php` helper + `tests/Feature/Filament/TranslationSafetyTest.php`: with `app()->setLocale('uk')`, `Livewire::test(EditPost::class, ['record' => $post->id])` asserts form data `name`/`content` equal the raw columns and `translations.uk.name` equals the translation; `->call('save')` leaves `name`, `content`, `slug`, `translations` unchanged; same for `EditPage`; verify it passes and that it fails when the trait is removed (temporarily).
- [ ] 2.3 `SetLocale`: resolve `/admin`, `/admin/*`, `/portfolio/*` to `Locales::default()` (design D3); add `tests/Feature/LegacyAdminLocaleTest.php` (`GET /admin/post-edit/{id}` as an authenticated user with `Accept-Language: uk` → Inertia prop `post.name` equals the raw column); verify it passes and the public/`/control` locale tests still pass.

## 3. Editor

- [ ] 3.1 Create `app/Filament/Support/ContentEditor.php` (design D1: toolbar groups, `s3` attachments, directory per resource, `public` visibility, image types, 2 MB); verify `php -l` and PHPStan.
- [ ] 3.2 Replace the six `RichEditor::make(...)` calls in `PostForm`/`PageForm` with `ContentEditor::make(...)` (`posts/content`, `pages/content`); verify each language tab shows the full toolbar and inserting an image on `/control/posts/create` uploads to MinIO (local `MINIO_*` config) and renders on the public post.
- [ ] 3.3 Write `tests/Feature/Filament/ContentEditorTest.php`: editor components on `CreatePost`/`EditPage` report disk `s3`, directories `posts/content`/`pages/content`, max size 2048, and the toolbar includes `h2`, `table`, `attachFiles`, `alignCenter`; with `Storage::fake('s3')`, `saveUploadedFileAttachment` of a 100 KB PNG stores under `posts/content/` and a 5 MB file is rejected; verify it passes.

## 4. Form layout and actions

- [ ] 4.1 Restructure `PostForm`/`PageForm` per design D4 (editor first, SEO section with `Textarea('description')` + counter, "Publishing"/"Placement" section outside the tabs, read-only slug under the name) keeping all field names and `translations.*` paths; verify create/edit of a post and a page in all three tabs saves the same data shape (`tests` from 1.2 still green) and PHPStan is clean.
- [ ] 4.2 Add the "View on site" header action to `EditPost` and `EditPage` (design D5; disabled for drafts / pages without a menu item); verify the link on a published post with the panel in `pl` is `/pl/blog/{slug}` and opens in a new tab.
- [ ] 4.3 Posts table: cover thumbnail, status badge, category, updated-since, search on name, status filter + published/draft shortcut, bulk publish/unpublish, default sort `updated_at desc`; Pages table: name, slug, page category, menu item, updated (design D6); verify in the browser and with `tests/Feature/Filament/PostsTableTest.php` (bulk publish of two drafts sets `status=published`).

## 5. Verification and rollout

- [ ] 5.1 Full suite, Pint, PHPStan green; `npm run build` unaffected (no Vite changes); verify `vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit` reports 0 failures.
- [ ] 5.2 Manual pass on local `/control` with the panel switched to Українська: edit an existing post that has inline `style=` in its content, save, compare the public rendering before/after (expected: styles dropped, structure intact); record the outcome in this file.
- [ ] 5.3 Push to `dev` → testing deploy; repeat 5.2 on the testing site including an image insert from the editor (MinIO) and "View on site"; then merge to `master` → production deploy; verify the production health check and `/control/posts` list render.
