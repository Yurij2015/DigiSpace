---
name: digispace-cms-content
description: "Modify DigiSpace public Blade pages, widgets, menus and content slots while preserving the category IDs and page resolution used by this CMS."
---

# DigiSpace CMS content

Read [content model](../../../docs/content-model.md) for content edits and [architecture](../../../docs/architecture.md) when tracing a public request. Paths are relative to this skill; code paths below are repository-relative.

## Trace the slot before editing

- Start with `routes/web.php`, the public controller, and its `resources/views` template or `app/View/Components` class. Public responses use Blade; Inertia is the admin surface.
- Identify the widget category in `config/constants.php` or controller constants, and any `page_widget` attachment. A valid widget alone may not make it visible on a page.
- `/pages/{slug}` resolves `MenuItem.slug` → first attached page. `Page.slug` alone is insufficient. Its image lookup uses widget subtitle equal to the URL slug and category `PAGES_IMAGES`.
- Global layout data comes from `ContentServiceProvider::boot()`. Its swallowed database exceptions can leave shared data absent. Trace the query before treating missing content as a styling problem.

## Preserve content contracts

Category IDs encode template slots. Do not renumber existing categories as part of unrelated content work. For a new slot, coordinate the constant, stable data row, page attachment and rendering code. Fresh `migrate --seed` has a known ID shift from the historical image-category migration; see [local setup](../../../docs/local-setup.md). Do not repair a populated database by rerunning all seeders: `UserSeeder` deletes users.

`Page` regenerates its slug from name on create/update. Check both menu slug and metadata after name changes. `IS_PROMO_TAB_ACTIVE` hides navigation, not route access.

Keep HTML content and its escaping context explicit; a TinyMCE field is not automatically safe for arbitrary user input. Match existing image storage per entity: widget/post URLs on S3, service/banner filenames on local public paths. Widget and post fallback accessors differ.

## Verify the visible result

For template/content behavior changes, check the affected page, shared header/footer if touched, metadata variables, and empty/image states. Use explicit category IDs in focused PHP fixtures. See [testing](../../../docs/testing.md) before database tests. For documentation-only changes, check source references and links.
