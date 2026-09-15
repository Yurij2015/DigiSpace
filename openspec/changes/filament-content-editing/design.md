---
type: Design
title: "Design — Filament content editing"
description: "Built-in TipTap rich editor via one shared factory, raw-value form filling for translatable records, default-locale legacy admin, and a three-group navigation."
tags: [design, admin, filament, editor, localization]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: post-form
    resource: repo://app/Filament/Resources/Posts/Schemas/PostForm.php
  - id: page-form
    resource: repo://app/Filament/Resources/Pages/Schemas/PageForm.php
  - id: edit-post
    resource: repo://app/Filament/Resources/Posts/Pages/EditPost.php
  - id: content-image
    resource: repo://app/Filament/Support/ContentImage.php
  - id: localized-content
    resource: repo://app/Models/Concerns/HasLocalizedContent.php
  - id: set-locale
    resource: repo://app/Http/Middleware/SetLocale.php
  - id: panel-provider
    resource: repo://app/Providers/Filament/AdminPanelProvider.php
  - id: filesystems
    resource: repo://config/filesystems.php
---

## Context

See `proposal.md` — Why. Observed state that shapes the approach:

- Filament **5.8.1** / Livewire 4.4. `RichEditor` is TipTap-based; the installed version exposes `toolbarButtons()`, `fileAttachmentsDisk/Directory/Visibility/AcceptedFileTypes/MaxSize()`, and tools `h2 h3 h4 bold italic underline strike subscript superscript link alignStart/Center/End/Justify blockquote codeBlock bulletList orderedList table horizontalRule attachFiles undo redo` (+ `customBlocks`, `mergeTags`, `details`, `highlight`). Default output is HTML.
- `PostForm`/`PageForm`: `Tabs('translations')` with English / Українська / Polski; base fields `name`, `content`, `description`, `keywords` (+ page `meta`), translation fields as `translations.{uk,pl}.*`; `slug` disabled and regenerated in `mutateFormDataBeforeSave` from `$data['name']`; post cover through `ContentImage::make('img_path', 's3', 'posts', true)` (stores the absolute URL).
- `HasLocalizedContent::localizedAttribute()` makes `name`, `content`, `description` (…) accessors return `translations.{app locale}.field ?? translations.en.field ?? raw`. `EditRecord::fillForm()` serialises the record through those accessors → the bug. `SetLocale` runs in the panel middleware (`AdminPanelProvider`), so the panel language switcher changes `app()->getLocale()` for the whole request.
- Navigation: `AdminPanelProvider::navigationGroups(['Portfolio management','Admin Layout Pages','Header','Blog sidebar','Footer'])` plus per-resource `getNavigationGroup()` strings (12 distinct values across 24 resources).
- Existing content (local copy): no `<table>`/`<iframe>`; some inline `style=`/`class=` from copy-paste; images on 13 pages as `<img src="https://…minio…">`.
- Tests: no Filament tests yet; `tests/Feature/Concerns/SeedsPublicSite` seeds chrome/categories; `UserFactory` exists; Filament admins are gated by `FILAMENT_ADMIN_EMAILS` (`config`) — tests must create a user whose e-mail is in that list.
- The `s3` disk (MinIO) has `throw => false` and no default `visibility`; `ContentImage` returns the public URL through `Storage::disk('s3')->url()`.

## Goals / Non-Goals

**Goals:**
- One place defines the content editor (`ContentEditor::make($name, $directory)`), used six times (2 resources × 3 languages).
- Zero risk of cross-locale overwrite in either admin.
- Sidebar an editor can read in two seconds.

**Non-Goals:**
- TinyMCE or any third-party editor package (decision below); raw-HTML source editing.
- Re-saving/normalising existing content in bulk (inline styles are dropped only when a record is edited and saved).
- Widgets, products, services forms beyond moving them into the Settings group.
- Changing the `translations` storage model or the public `HasLocalizedContent` behaviour.
- The legacy Inertia admin UI (only its request locale is pinned).

## Decisions

### D1 — Built-in `RichEditor` (TipTap), configured through `App\Filament\Support\ContentEditor`
`ContentEditor::make(string $name, string $attachmentsDirectory): RichEditor` returns `RichEditor::make($name)->toolbarButtons([['h2','h3','h4'],['bold','italic','underline','strike'],['bulletList','orderedList','blockquote','codeBlock'],['link','attachFiles','table','horizontalRule'],['alignStart','alignCenter','alignEnd'],['undo','redo']])->fileAttachmentsDisk('s3')->fileAttachmentsDirectory($attachmentsDirectory)->fileAttachmentsVisibility('public')->fileAttachmentsAcceptedFileTypes([...jpeg,png,gif,webp])->fileAttachmentsMaxSize(2048)->columnSpanFull()`. Directories: `posts/content`, `pages/content`. The editor embeds the attachment URL returned by the disk (`Storage::disk('s3')->url()`), i.e. the same absolute-URL convention as `ContentImage`.

Why not TinyMCE: the only Filament-5-compatible package (`amidesfahani/filament-tinyeditor` ^5.0) is third-party and cloud-key-metered; three editors per form multiply loads; the existing content needs nothing TipTap lacks. Reversible: the factory is the single seam where a TinyMCE component could be swapped in for one field later.

### D2 — Raw-value form filling via `FillsRawTranslatableFields`
A trait for `EditRecord` pages: `mutateFormDataBeforeFill(array $data): array` overwrites `$data[$field] = $this->getRecord()->getRawOriginal($field)` for every field in `static::$rawFields` (`['name','content','description','keywords']` for posts, `+ 'meta'` for pages; categories/services/products get their own lists), and sets `$data['translations']` from the raw JSON. `mutateFormDataBeforeSave` keeps regenerating `slug` from `$data['name']` — which is now guaranteed to be the base value. Applied to every `Edit*` page whose model uses `HasLocalizedContent` (Post, Page, Category, Service, ServiceCategory, Product).

Alternative rejected: making `localizedValue()` return raw when `Filament::isServing()` — hides the behaviour inside the model and would also change Filament table columns (which should show the UI-locale value). Explicit per-page fill is testable and local.

### D3 — Legacy `/admin` and `/portfolio` requests resolve in the default locale
`SetLocale` short-circuits to `Locales::default()` when `$request->is('admin/*', 'admin', 'portfolio/*')`. The Inertia forms only edit base-language columns, so serialising with accessors in `en` yields raw values (the `?? raw` fallback) — no controller changes. The public site and `/control` are unaffected.

### D4 — Form layout
Inside each language tab: `ContentEditor` first, then a `Section('SEO')` with `Textarea('description')->rows(3)->maxLength(255)->helperText(counter)`, `TextInput('keywords')`, page `TextInput('meta')`. Outside the tabs, a two-column `Section`: posts — `Select('category_id')`, `Select('status')`, `ContentImage('img_path')` ("Publishing"); pages — `Select('page_category_id')`, `Select('menu_item_id')`, `Select('widgets')` ("Placement"). `slug` shown read-only under the name. Field names and translation paths unchanged, so stored data shape is identical.

### D5 — "View on site" action
`Action::make('viewOnSite')->url(fn ($record) => route('blog.post', ['locale' => app()->getLocale(), 'postSlug' => $record->slug]), shouldOpenInNewTab: true)->disabled(fn ($record) => $record->status !== 'published')->tooltip(...)`. Pages: `route('pages.page', ['locale' => …, 'slug' => $record->menuItem?->slug])`, disabled when no menu item is attached (public resolution is MenuItem → page).

### D6 — Tables and bulk actions
Posts table: `ImageColumn('img_path')->circular()` (absolute URL, no disk), `TextColumn('name')->searchable()->sortable()`, `TextColumn('category.name')`, `TextColumn('status')->badge()->color(match)`, `TextColumn('updated_at')->since()`; filters `SelectFilter('status')` + `TernaryFilter('published')` shortcut; `BulkAction('publish')` / `('unpublish')` updating `status` (posts only). Pages table: name, slug, page category, menu item, updated. Default sort `updated_at desc`.

### D7 — Navigation
`AdminPanelProvider::navigationGroups([NavigationGroup::make('Content'), NavigationGroup::make('Settings')->collapsed(), NavigationGroup::make('Portfolio')->collapsed()])`; every resource's `getNavigationGroup()` returns one of the three and `getNavigationSort()` orders within the group (Content: Posts 10, Categories 20, Pages 30, Blog banners 40; Settings: Products 10, Product services 20, Services 30, Service categories 40, Widgets 50, Widget icons 60, Menus 70, Menu items 80, Header 90, Footer bottom bar 100, Useful links 110; Portfolio: existing order). Group labels through `__()` keys so the panel language switcher translates them.

### D8 — Tests (Livewire/Filament)
`tests/Feature/Filament/` with a `MakesFilamentAdmin` helper (user whose e-mail is added to `config('filament.admin_emails')`/`FILAMENT_ADMIN_EMAILS` at runtime, `actingAs`, `Filament::setCurrentPanel`). Cases: `EditPost` filled with `app()->setLocale('uk')` shows raw `name`/`content` and `translations.uk.*`, and `->call('save')` leaves the row unchanged; `saveUploadedFileAttachment` on the editor stores under `posts/content` on `Storage::fake('s3')`; navigation groups/sort assertions through `Filament::getNavigation()`; "View on site" URL; `GET /admin/posts/{id}/edit` with `Accept-Language: uk` returns base values in Inertia props. All use `RefreshDatabase` + `SeedsPublicSite`.

## Risks / Trade-offs

- [Inline styles from old content dropped on re-save] → documented in proposal; verified visually on a page with `style=` before/after in the testing environment; theme CSS governs public look.
- [`fileAttachmentsVisibility('public')` on MinIO buckets that ignore ACLs] → URLs are public via bucket policy already (existing images work the same way); if `putFile` with visibility errors, drop the visibility call — `throw => false` on the disk would otherwise mask it, so the test asserts the file exists.
- [Livewire temporary uploads on CloudPanel (`livewire.temporary_file_upload`)] → the existing `ContentImage` upload path already proves the pipeline on prod.
- [Panel UI locale ≠ content locale confusion] → "View on site" follows the panel locale; tabs are always all three languages.
- [Raw fill misses a field added later] → `$rawFields` lists are asserted in tests against the model's localized attribute list.

## Migration Plan

No schema changes. Deploy through the normal pipeline (`dev` → testing first); verify on testing: open/edit/save a post and a page in each tab with the panel in `uk`, insert an image, "View on site", bulk publish; then `master` → production. Rollback = previous release (stored HTML is compatible both ways).

## Open Questions

- Should the "Content" group also hold Widgets (they are page content in practice)? Assumed **no** (widgets are template slots tied to category IDs — configuration); trivial to move later.
- Panel group labels localized (`Контент`/`Налаштування`) or English only? Assumed localized via `lang/*/site.php`-style keys in a new `lang/*/admin.php`; no structural impact.
