---
type: Reference
title: "Content Model"
description: "Widgets, widget categories, pages, menus and site-chrome tables that drive the public site, and the seeded IDs they depend on."
tags: [cms, widgets, pages, menus, seeders]
status: stable
stale_after: 2027-03-13
---

# Content Model

The public site is assembled from database rows, not hard-coded templates. Templates know *which widget category* to render in a given slot; admins fill the slot from `/admin/widgets`.

## Entities

```
widget_categories 1───* widgets 1───* widget_icons
        │
        │ (category id = slot on the site; see constants below)
        │
pages *───* widgets            (pivot: page_widget)
pages *───1 page_categories
pages *───1 menu_items *───1 menus      (menu_items.slug is the public URL segment)

products *───* services (pivot product_service, carries css classes)   ← pricing/cards on home
services *───1 service_categories                                     ← /service-category/{slug}
posts *───1 categories, posts *───1 users, posts 1───1 blog_post_banners  ← blog

header_nav_bar_contents, footer_bottom_bar_contents, footer_useful_links, settings  ← site chrome (singletons/lists)
contact_forms, subscribers                                             ← inbound from visitors
```

### Widgets

`widgets`: `title`, `subtitle`, `content` (HTML from TinyMCE), `widget_image` (s3 object key), `icon`, `css_class`, `anchor`, `element_id`, `widget_category_id`.
`Widget::widgetImage` accessor resolves the key via `Storage::disk('s3')->url()` and returns the `widgets/no_image.png` object URL when empty. `widget_icons` hold Font Awesome classes/URLs for list-type widgets.

### Pages

`pages`: `slug`, `name`, `meta` (keywords), `description`, `content`, `page_category_id`, `menu_item_id`. Slug is auto-generated from `name` in `Page::boot()` on create/update.
A page's blocks are the widgets attached via `page_widget`; controllers load them filtered by category, e.g. `ContactController::getContactUsPageComponent()` loads the `contact-us` page with only `GET_IN_TOUCH` widgets.

**URL resolution:** `GET /pages/{slug}` → `PageController::show` looks up **`MenuItem` by slug**, then takes `menuItem->pages->first()`. A page that is not linked to a menu item is not reachable at `/pages/...`. The hero image for such a page is the widget whose `subtitle == slug` in category `PAGES_IMAGES`.

### Menus

`menus` (id, name) → `menu_items` (name, slug, href). Three sub-menus are pulled globally by id (`PAGE_SUBMENU_FIRST/SECOND/THIRD`) in `ContentServiceProvider` and rendered by the header component. Editing: `/admin/top-menu`.

### Site chrome

- `header_nav_bar_contents` — phone/email/socials in the top bar (`/admin/top-bar-settings`), first row wins.
- `footer_bottom_bar_contents` — copyright line (`/admin/bottom-bar-settings`), first row wins.
- `footer_useful_links` — `name`, `url`, `status`, `position`; split into two columns by `FOOTER_USEFUL_LINKS_COL_LEFT/RIGHT`, max 20 active (`/admin/useful-link-list`).
- `settings` — key/value, currently barely used (counts still live in `config/constants.php`).

### Translations

Every CMS entity that renders on the public site carries a nullable `translations` JSON column shaped `{"uk": {field: value}, "pl": {...}}` next to the base (English) columns: `posts`, `pages`, `categories`, `services`, `service_categories`, `products` **and** the structure — `menus.title`, `menu_items.name`, `widgets.title/subtitle/content`, `widget_categories.name/title/description`, `footer_useful_links.name`, `header_nav_bar_contents.*_col_name/first_col_href_content`, `footer_bottom_bar_contents.privacy_policy_title/faq/support`. Models use `HasLocalizedContent`: reading `$widget->title` resolves *request locale → en → base column*, so Blade needs no changes. `App\Support\Translations` prunes empty values on write (a blank `<p></p>` from the editor is not a translation). Each model lists its translatable base columns in `TRANSLATABLE` (`HasTranslatableColumns`) so the control panel fills edit forms from raw values.

**Slot keys.** Templates that pick a widget for a layout slot must not compare the (now localized) title. The footer uses `Widget::slot` = `element_id` (`footer-phone`, `footer-subscribe`, `footer-about`, `footer-latest-news`, `footer-useful-links`), falling back to the base-language title for rows without a key. `StructureTranslationsSeeder` backfills these keys.

## Magic IDs (`config/constants.php`)

The category/menu constants are expected primary keys; column and pagination constants are not database IDs. The seeders assume insertion order, but the image-category migration runs before seeding and shifts fresh-install IDs. The table describes the intended mapping, not a guarantee about a newly seeded database:

| Constant | Value | Seeded category | Rendered by |
|---|---|---|---|
| `WIDGET_CATEGORY_PROJECTS` | 10 | Our Clients | `OurProjects` component, home + about |
| `FOOTER_CATEGORY` | 11 | Footer | `Footer` component (via `View::share`) |
| `CHOOSE_US_WIDGET_CATEGORY` | 12 | Why Choose Us | `ChooseUsComponent`, home + services |
| `ANSWERS_QUESTIONS_WIDGET_CATEGORY` | 13 | Frequently Asked Questions | services/FAQ |
| `AboutController::GENERAL_INFO_WIDGET_CATEGORY` | 7 | About \| General Info | about page |
| `AboutController::TEAM_INFO` | 8 | About \| Team | about page |
| `AboutController::SOME_FACTS_ABOUT` | 9 | Some Facts About Us | `SomeFactsAboutUsMain` component |
| `PromoController::PROMOS` | 14 | Promos | `/promos` (flag hides navigation only; route remains public) |
| `ContactController::GET_IN_TOUCH` | 15 | Get in Touch | contact page |
| `PAGES_IMAGES` | 16 | Images for pages (inserted by the 2023-06-11 migration without explicit ID) | hero image on `/pages/{slug}` |
| `PAGE_SUBMENU_FIRST/SECOND/THIRD` | 2/3/4 | menus 2–4 | header sub-menus |
| `FOOTER_USEFUL_LINKS_COL_LEFT/RIGHT` | 1/2 | column index | footer links |
| `WIDGET_PER_PAGE`, `SERVICES_PER_PAGE`, `NUMBER_POSTS_IN_MENU`, `NUMBER_POSTS_IN_BLOG_PAGE` | 5/20/6/3 | pagination sizes | — |

Categories 1–6 (`Landing. *`) are used by `LandingController` with literal ids (`4`, `5`). Some ids are class constants on controllers instead of `config/constants.php` (table above) — grep for `widget_category_id` and `public const` before assuming a category is unused, and prefer adding new ids to `config/constants.php`.

Rules:
1. Preserve category IDs used by templates and existing data; verify the actual database mapping before changing it.
2. Adding a new slot = new constant **and** new seeder row **and** (for existing environments) a one-off insert — `database/sql/` holds examples of such historical patches.
3. When a page renders empty in a fresh environment, the first suspect is a missing category row for one of these ids.

## Image fallbacks

Image columns hold s3 object keys, and accessors resolve them via `Storage::disk('s3')->url()` — the public base comes from `AWS_URL` (R2 public URL or a future custom domain). Empty `widgets.widget_image` falls back to `widgets/no_image.png`, empty `services.image` to `services/no_image.png`; `Post::imgPath()` returns the stored value unchanged. Inspect both the accessor and the consuming template before changing fallback behavior.

## Where uploads end up

| Entity | Storage | Stored value |
|---|---|---|
| `widgets.widget_image`, `posts.img_path`, `services.image`, `blog_post_banners.img_path` | s3 disk (`widgets/…`, `posts/…`, `services/…`, `banners/…`, `articles/…`) | object key |
| Rich-text attachments (`posts.content`, `pages.content`, `services.description`) | s3 disk (`posts/content`, `pages/content`, `services/content`) | absolute URL embedded in HTML |

`public/images` (theme assets) is preserved by the deploy workflow; `public/uploads`/`public/banners` are legacy — the app no longer reads them.

## Admin entry points

| Content | Admin URL | Controller |
|---|---|---|
| Widgets / icons | `/admin/widgets`, `/admin/widget-icons/{widget}` | `Admin\WidgetController`, `Admin\WidgetIconController` |
| Pages (custom) | `/admin/pages` | `Admin\PagesController` |
| Default pages (seeded, read-mostly) | `/admin/dafault-pages` | `Admin\DefaultPagesController` |
| Menu | `/admin/top-menu` | `Admin\HeaderTopMenuController` |
| Header / footer bars, useful links | `/admin/top-bar-settings`, `/admin/bottom-bar-settings`, `/admin/useful-link-list` | respective controllers |
| Services / categories / products | `/admin/services`, `/admin/service-categories`, `/admin/products` | `Admin\Service*`, `Admin\ProductController` |
| Blog posts / categories / banners | `/admin/posts`, `/admin/categories`, `/admin/posts-banners` | `Admin\PostController`, `Admin\CategoryController`, `Admin\BlogPostBannerController` |
| Portfolio (CV) | `/portfolio/education`, `/portfolio/skills`, `/portfolio/sections` | `Admin\Portfolio\*` |
