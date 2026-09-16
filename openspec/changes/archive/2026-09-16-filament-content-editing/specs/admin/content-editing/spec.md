---
type: Behaviour Spec
title: "Admin — Content editing (posts and pages)"
description: "How posts and pages are edited in the control panel: visual editor with image insertion, form layout, preview, list conveniences, and the guarantee that editing one locale never alters another."
tags: [admin, filament, editor, posts, pages, localization]
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
  - id: post-model
    resource: repo://app/Models/Post.php
---

## Purpose

Lets a content manager write and maintain blog posts and CMS pages in three languages from the control panel with a real visual editor, without ever corrupting the content of another language or the public URL of the record.

## ADDED Requirements

### Requirement: Visual editor for content fields
The `content` field of a post and of a page, in every language tab, MUST be a visual (WYSIWYG) editor that offers at least: headings (H2–H4), bold, italic, underline, strikethrough, ordered and unordered lists, blockquote, inline code, links, text alignment, tables, horizontal rule, undo/redo and image insertion. The editor MUST store HTML so the public templates render it unchanged.

#### Scenario: Formatting is preserved through save and public render
- **WHEN** an editor writes a heading, a bulleted list and a link in the English content and saves the post
- **THEN** the stored `content` contains the corresponding HTML elements and the public post page renders them

#### Scenario: Same editor in every language tab
- **WHEN** the editor opens the Українська or Polski tab
- **THEN** the content field there offers the same toolbar as the English one

### Requirement: Images are inserted from the editor and stored on object storage
Inserting an image from the editor MUST upload it to the `s3` disk under `posts/content` (posts) or `pages/content` (pages), accept JPEG/PNG/GIF/WebP up to 2 MB, and embed it as an absolute public URL so it renders on the public site without further processing.

#### Scenario: Image inserted into a page
- **WHEN** the editor attaches a PNG inside the page content and saves
- **THEN** the file exists on the `s3` disk under `pages/content/` and the stored HTML contains an `<img src="https://…">` pointing at it

#### Scenario: Oversized file
- **WHEN** the editor attaches a 5 MB image
- **THEN** the upload is rejected with a visible validation message and the content is unchanged

### Requirement: Content-first form layout
The post and page forms MUST show, inside each language tab, the content editor first and the SEO/meta fields (`description`, `keywords`, page `meta`) grouped below it; `description` MUST be a multi-line field with a character counter and its 255-character limit. Record-level fields (category, status, cover image; page category, widgets, menu item) MUST sit outside the language tabs, grouped as "Publishing" (posts) / "Placement" (pages). The uk/pl tabs MUST keep the same field set as today.

#### Scenario: Post form structure
- **WHEN** the create-post form is rendered
- **THEN** the English tab shows the editor above the description/keywords group, and category, status and cover image are outside the tabs

### Requirement: Preview of the public page
Edit pages for posts and pages MUST offer a "View on site" action that opens the record's public URL in the language currently selected in the panel, in a new tab; for a draft post the action MUST be disabled with a hint.

#### Scenario: Published post
- **WHEN** an editor with the panel in Ukrainian opens a published post and activates "View on site"
- **THEN** `/uk/blog/{slug}` opens in a new tab

### Requirement: List conveniences
Post and page lists MUST show a status badge (posts), category, cover thumbnail (posts), name, slug and updated date; MUST offer quick filters for published/draft posts and search by name; and MUST offer bulk publish/unpublish for posts.

#### Scenario: Bulk publish
- **WHEN** an editor selects three draft posts and runs "Publish"
- **THEN** all three become `published` and appear on the public blog

### Requirement: Editing never alters another locale
Opening an edit form MUST fill every base-language field (`name`, `content`, `description`, `keywords`, `meta`) from the stored base value regardless of the panel UI language, and saving MUST write base fields to base columns and `uk`/`pl` fields to the corresponding `translations` entries only. The slug MUST be derived from the base-language name only.

#### Scenario: Panel in Ukrainian, post has a Ukrainian translation
- **WHEN** the panel UI locale is `uk` and an editor opens a post whose `translations.uk.name` differs from `name`
- **THEN** the English tab shows the stored `name`/`content`, the Українська tab shows the `uk` values, and saving without changes leaves `name`, `content`, `slug` and `translations` byte-identical

#### Scenario: Legacy admin request
- **WHEN** a request to `/admin/*` arrives with a Ukrainian browser language or session locale
- **THEN** the legacy form data is produced from base-language values
