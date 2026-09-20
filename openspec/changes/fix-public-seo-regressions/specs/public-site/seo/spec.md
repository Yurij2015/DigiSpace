---
type: capability
title: Public site SEO
description: Accurate page metadata and complete localized sitemap entries.
tags: [public-site, seo, localization]
status: proposed
last_verified_at: null
sources:
  - repo://resources/views/layouts/main.blade.php
  - repo://app/Support/SchemaMarkup.php
  - repo://app/Console/Commands/GenerateSitemap.php
---

## Purpose

Ensure search engines and social previews receive metadata for the requested page and can discover every supported language version.

## ADDED Requirements

### Requirement: Metadata describes the requested resource
The site MUST choose description, Open Graph and Twitter metadata from the requested resource in its resolved language. Blog listings MUST retain their page title, site description and default image regardless of listed posts. Only individual blog posts MUST use the article Open Graph type. JSON-LD MUST describe the same resource and remain safely encoded valid JSON.

#### Scenario: Blog listing contains posts
- **WHEN** a visitor opens a blog listing, category, archive or search containing posts
- **THEN** its metadata and WebPage node describe the listing and do not inherit the last post's metadata

#### Scenario: Individual article
- **WHEN** a visitor opens a published blog post
- **THEN** its social metadata and BlogPosting describe that post and its own image

#### Scenario: Individual service
- **WHEN** a visitor opens a service with localized SEO fields
- **THEN** its title uses the service SEO title, its description uses the service SEO description, and its social image uses the service image
- **AND** an empty SEO title falls back to the service title and an empty description falls back to the localized site description

#### Scenario: Service category and CMS page
- **WHEN** a visitor opens a service category or CMS page
- **THEN** metadata uses that category or page's localized fields and preserves the appropriate JSON-LD type

### Requirement: Social image URLs are absolute
Open Graph and Twitter image values MUST be absolute HTTP(S) URLs. CMS images supplied as a filename, upload path or root-relative path MUST resolve to the intended public asset; existing absolute URLs MUST retain their host and path. Missing CMS images MUST use the default image.

#### Scenario: Root-relative CMS image
- **WHEN** a CMS page image is stored as `/uploads/widgets/page.jpg`
- **THEN** both social image tags contain an absolute URL for that asset

#### Scenario: Filename or absolute image
- **WHEN** a CMS page supplies `page.jpg` or `https://cdn.example.com/page.jpg`
- **THEN** the filename resolves under `/uploads/widgets/` and the absolute URL remains unchanged

### Requirement: Sitemap enumerates every language version
Every included resource MUST have one sitemap URL entry per supported locale. Every entry MUST contain identical alternate links for all supported locales, including itself, and x-default pointing to the configured default locale. Existing published-post and active-service eligibility filters MUST remain effective.

#### Scenario: Multilingual resource
- **WHEN** the sitemap is generated for English, Ukrainian and Polish
- **THEN** each included static page, CMS page, published post, blog category, archive, service category and eligible service has three entries with reciprocal alternates

#### Scenario: Unpublished content
- **WHEN** drafts and inactive services exist alongside published posts and active services
- **THEN** those drafts and inactive services do not appear as sitemap entries

### Requirement: Public error pages are not indexed
All public 404 responses MUST include a noindex robots meta tag, including missing resources, unknown paths and the minimal error view. Successful ordinary public pages MUST NOT inherit the error indexing directive. Search pages MUST retain noindex.

#### Scenario: Unknown path or missing resource
- **WHEN** a request returns a public 404 page
- **THEN** its HTTP status is 404 and its HTML contains the noindex directive

#### Scenario: Minimal error fallback
- **WHEN** a 404 is rendered without the shared site chrome
- **THEN** the fallback HTML also includes noindex
