---
type: Behaviour Spec
title: "Public site — Navigation and reachability"
description: "Every public entry point resolves to a branded page: legacy unprefixed URLs, footer links, unknown URLs and locale-safe assets."
tags: [public-site, navigation, seo, localization]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: routes
    resource: repo://routes/web.php
  - id: header
    resource: repo://resources/views/components/header.blade.php
  - id: footer-bottom-bar
    resource: repo://resources/views/components/footer-bottom-bar-content.blade.php
  - id: not-found-view
    resource: repo://resources/views/errors/page-not-found.blade.php
  - id: home
    resource: repo://resources/views/home/index.blade.php
---

## Purpose

Guarantees that a visitor arriving at any public URL — bookmarked, indexed, or clicked inside the site — lands on a working, branded DigiSpace page in the right locale instead of a dead link or a framework error page.

## ADDED Requirements

### Requirement: Unprefixed public URLs remain reachable
Every public URL that existed before the locale prefix was introduced (`/about`, `/services`, `/pricing`, `/promos`, `/blog`, `/blog/{slug}`, `/blog-category/{slug}`, `/blog-archive/{yearMonth}`, `/blog-search`, `/contact-us`, `/pages/{slug}`, `/service-category/{slug}`, `/service-category/{slug}/{service}`, `/service-search`, `/faq`, `/privacy-policy`, `/support`, `/page-not-found`) MUST resolve without a locale segment. The response MUST be the page rendered in the locale resolved for the request (session, then browser preference, then default), or a 301/302 redirect to the equivalent locale-prefixed URL. It MUST NOT be a 404.

#### Scenario: Legacy top-level page URL
- **WHEN** a visitor requests `GET /about` with no locale segment and no locale in session
- **THEN** the response is HTTP 200 for the About page or a redirect to `/{default-locale}/about`, and the final page has `<html lang>` equal to the resolved locale

#### Scenario: Legacy blog post URL
- **WHEN** a visitor requests `GET /blog/{existing-post-slug}`
- **THEN** the blog post is served (200) or redirected to its locale-prefixed URL; the canonical and `hreflang` links on the final page are locale-prefixed

#### Scenario: Prefixed URLs are unchanged
- **WHEN** a visitor requests `GET /uk/about` or `GET /pl/blog`
- **THEN** the response is HTTP 200 exactly as before this change

### Requirement: Footer bottom-bar links resolve
The privacy policy, FAQ and support links in the footer bottom bar MUST point to a reachable page for the current locale, regardless of whether the stored value is an unprefixed path.

#### Scenario: Footer links on a localized page
- **WHEN** a visitor on `/uk/about` clicks "FAQ", "Support" or the privacy policy link
- **THEN** the destination responds HTTP 200 with the FAQ/Support/Privacy page in the `uk` locale

### Requirement: Unknown URLs render the branded 404 page
Any public URL that matches no route or no content MUST return HTTP 404 with the branded DigiSpace layout (header, footer, language switcher), a title and heading that describe "page not found" in the resolved locale, and links back to the home page and blog.

#### Scenario: Unmatched route
- **WHEN** a visitor requests `GET /this-does-not-exist`
- **THEN** the response is HTTP 404, contains the site header and footer, and its `<title>` is not the About page title

#### Scenario: Missing content slug
- **WHEN** a visitor requests `GET /uk/pages/does-not-exist` or `GET /uk/blog/does-not-exist`
- **THEN** the response is HTTP 404 with the same branded 404 layout and Ukrainian copy

### Requirement: No dead or placeholder links in the public chrome
Navigation, header search and content links in the public layout MUST target a real route. Placeholders (`href="#"`, theme leftovers such as `search-results.html`) MUST NOT be rendered for interactive elements; a decorative label with no destination MUST be rendered as non-link text or the element MUST be removed.

#### Scenario: Header search
- **WHEN** a visitor submits the header search field with a query
- **THEN** the browser navigates to the site's search results page for that query in the current locale and the results page responds HTTP 200

#### Scenario: Blog author label
- **WHEN** a blog listing or post shows the author name
- **THEN** the author name is rendered as plain text, or as a link whose destination responds HTTP 200

#### Scenario: Pages menu label
- **WHEN** the "Pages" mega-menu label is rendered in the header
- **THEN** activating it opens the mega-menu and does not navigate to `#`

### Requirement: Asset URLs are locale-prefix safe
Every image, background and script URL rendered by the public layout MUST be absolute (root-relative or fully qualified) so it resolves identically under `/`, `/uk/...` and `/pl/...`.

#### Scenario: Home slider under a locale prefix
- **WHEN** a visitor loads `/uk`
- **THEN** every `data-slide-bg`, `data-parallax-img`, `src` and `href` asset URL in the response responds HTTP 200 and none starts with a bare `images/` path
