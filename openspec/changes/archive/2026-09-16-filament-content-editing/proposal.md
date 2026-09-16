---
type: Change Proposal
title: "Proposal — Filament content editing: rich editor with image uploads, content-first navigation, safe translations"
description: "Make posts, categories and pages comfortable to manage in the /control panel: the built-in TipTap rich editor with a full toolbar and MinIO image uploads, a Content/Settings navigation split, editing conveniences, and a fix so admin forms never overwrite the base-language content with a translation."
tags: [proposal, admin, filament, editor, content, localization]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: post-form
    resource: repo://app/Filament/Resources/Posts/Schemas/PostForm.php
  - id: page-form
    resource: repo://app/Filament/Resources/Pages/Schemas/PageForm.php
  - id: edit-post
    resource: repo://app/Filament/Resources/Posts/Pages/EditPost.php
  - id: localized-content
    resource: repo://app/Models/Concerns/HasLocalizedContent.php
  - id: panel-provider
    resource: repo://app/Providers/Filament/AdminPanelProvider.php
  - id: content-image
    resource: repo://app/Filament/Support/ContentImage.php
  - id: admin-spec
    resource: repo://openspec/specs/admin/filament-panel.spec.md
---

## Why

The `/control` panel now has resources for everything, but editing the two things that change every week — blog posts and CMS pages — is clumsy: the `RichEditor` fields are left at their defaults (no image insertion, no tables, no alignment, no upload target — so images cannot be placed in the text at all), the form is a flat list where the long text sits between meta fields, and the 24 resources sit in twelve ad-hoc navigation groups ("Admin Layout Pages", "Top bar settings", …) so the content manager has to hunt for Posts. On top of that, the code review found that opening a post or page while the admin UI is in Ukrainian or Polish pre-fills the *English* tab with the translation and **Save overwrites the base content and slug** — a data-loss bug that becomes more likely the more the panel is used.

## What Changes

- **Visual editor** — `content` fields of Posts and Pages (all three language tabs) use Filament 5's built-in TipTap `RichEditor` through one shared factory (`ContentEditor::make()`): full toolbar (headings, bold/italic/underline/strike, lists, blockquote, code, links, alignment, table, horizontal rule, undo/redo, **attach image**), **image uploads from the editor straight to MinIO** (`s3` disk, `posts/content` / `pages/content`, public visibility), HTML output so `{!! $post->content !!}` keeps working. Decision over TinyMCE: the existing content has no tables/iframes (only stray inline styles from copy-paste), three editors per form make the zero-dependency, no-cloud-key option the lighter one; a TinyMCE plugin can still be added later for a single field if raw-HTML editing is ever needed. Legacy `TINY_MCE_API_KEY` stays for the old admin only.
- **Content-first navigation** — two groups replace the current twelve: **Content** (Posts, Categories, Pages, Blog banners) at the top, and **Settings** (Products, Services, Service categories, Widgets, Widget icons, Menus, Menu items, Header, Footer, Useful links). The Portfolio module keeps its own **Portfolio** group (nine resources would drown Settings). Groups are collapsible; Settings starts collapsed.
- **Editing conveniences for Posts and Pages** — a "Content / SEO" sectioning inside each language tab (long text first, meta fields grouped), `description` as a textarea with counter, cover image (`img_path`) next to the status, a **"View on site"** header action that opens the localized public URL, table columns for status badge, category, cover thumbnail and updated date, "published / draft" quick filters, and bulk publish/unpublish. Pages get the same layout plus their widgets/menu-item selects grouped as "Placement".
- **Translation safety (bug fix, code-review HIGH #1)** — Filament edit forms are filled from the **raw** column values, never from the locale-aware accessors, so the English tab always shows English and saving never copies a `uk`/`pl` value into the base columns or regenerates the slug from it. The same guarantee for the legacy `/admin` Inertia forms is achieved by resolving those requests in the default locale (they only edit base-language content).
- **Kept**: the uk/pl translation tabs exactly as they are (the user finds them convenient), the `translations` JSON storage, slugs derived from the English name, `ContentImage` S3 upload helper.

No **BREAKING** changes for visitors: stored content stays HTML. Known effect: when an existing record is *re-saved*, inline `style="…"` attributes from old copy-paste are dropped by the editor (headings, lists, links, images are preserved); public styling comes from the theme CSS, not from those attributes.

## Capabilities

### New Capabilities
- `admin/content-editing`: how posts and pages are edited in the control panel — visual editor, image insertion, form layout, preview, list conveniences, and the guarantee that editing one locale never alters another.
- `admin/navigation`: how panel resources are grouped and ordered so content management is the first thing an editor sees.

### Modified Capabilities
<!-- `admin/filament-panel` (openspec/specs/admin/filament-panel.spec.md) is not in delta format and none of its
     requirements change; the new specs add to the same domain directory. -->

## Impact

- **Dependencies**: none added (built-in `RichEditor`).
- **Code**: `app/Filament/Resources/{Posts,Pages,Categories,BlogPostBanners,...}` (navigation group/sort, forms, tables, header actions), new `app/Filament/Support/ContentEditor.php` (rich editor factory) and `app/Filament/Support/FillsRawTranslatableFields.php` (edit-page trait), `app/Providers/Filament/AdminPanelProvider.php` (`navigationGroups`), `app/Http/Middleware/SetLocale.php` (default locale for `/admin/*`, `/portfolio/*`), `config/filesystems.php` only if the `s3` disk needs `visibility`.
- **Tests**: Filament feature tests for edit-form filling with a non-English UI locale (raw values, no overwrite on save), editor configuration (attachment disk/directory, toolbar) on create/edit pages, navigation group membership, "View on site" URL; existing suite must stay green (`SeedsPublicSite` fixture).
- **Deploy**: no schema change; `after-deploy.sh` already runs `livewire:publish --assets`, which also ships the editor assets. Vite build unaffected.
- **Not affected**: public rendering (`{!! $post->content !!}`), `HasLocalizedContent` read behaviour on the public site, the legacy Inertia admin UI itself (only its request locale), deployment pipeline.
