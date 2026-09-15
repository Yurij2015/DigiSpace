---
type: Behaviour Spec
title: "Public site — Localized UI chrome"
description: "Visitor-facing UI strings in the public layout, breadcrumbs, section headings and home hero render in the resolved locale."
tags: [public-site, localization, i18n, ux]
status: proposed
last_verified_at: 2026-09-14
sources:
  - id: dictionaries
    resource: repo://lang/en/site.php
  - id: layout
    resource: repo://resources/views/layouts/main.blade.php
  - id: home
    resource: repo://resources/views/home/index.blade.php
  - id: language-switcher
    resource: repo://resources/views/components/language-switcher.blade.php
  - id: locales-config
    resource: repo://config/locales.php
---

## Purpose

Ensures a visitor who chooses Ukrainian or Polish sees the whole page chrome in that language, not a mix of translated navigation and English headings, buttons and hero copy.

## ADDED Requirements

### Requirement: Static UI strings come from the locale dictionaries
Every visitor-facing string authored in Blade templates for the public site (navigation labels, breadcrumb items, breadcrumb titles, section headings such as "Our Services"/"Pricing Plans"/"Categories"/"Archive", button captions such as "Read More"/"Subscribe"/"Send Message", the "by" author prefix, search placeholders, 404 copy and page `<title>` values) MUST be looked up in the `site` dictionary and MUST exist with a value for every supported locale (`en`, `uk`, `pl`).

#### Scenario: Dictionary parity
- **WHEN** the `en`, `uk` and `pl` `site` dictionaries are compared
- **THEN** they contain exactly the same set of keys and no empty values

#### Scenario: Ukrainian breadcrumb
- **WHEN** a visitor loads `/uk/about`
- **THEN** the breadcrumb shows the Ukrainian words for "Home" and "About" and the page `<title>` is the Ukrainian about-title

#### Scenario: Polish 404
- **WHEN** a visitor requests an unknown URL with the `pl` locale in session
- **THEN** the 404 heading, explanation and the "go to home"/"go to blog" buttons are Polish

### Requirement: Home hero content is localized
The home page hero slides (headline, paragraph, call-to-action caption) MUST render in the resolved locale for `en`, `uk` and `pl`.

#### Scenario: Ukrainian home hero
- **WHEN** a visitor loads `/uk`
- **THEN** the first slide's `<h1>` and call-to-action are Ukrainian, and the slide's "Read more" link points to the localized page route

### Requirement: Language switcher is consistent and usable without scripting
The language switcher MUST list every supported locale using the label defined for it in configuration, mark the current locale as selected, and MUST offer a way to apply the selection that works when scripting is unavailable. Its placement MUST not overlap the mobile navigation toggle or the brand logo at viewport widths down to 320 px.

#### Scenario: Labels follow configuration
- **WHEN** the switcher is rendered
- **THEN** each option's visible label is derived from `config('locales.labels')` (or a short code mapped from it) and the current locale's option is selected

#### Scenario: No-JS fallback
- **WHEN** a visitor with scripting disabled changes the selected language and submits
- **THEN** the browser navigates to the same page in the chosen locale
