---
type: capability
title: Public site cookie consent
description: Opt-in consent banner that gates non-essential trackers and lets visitors change their choice.
tags: [public-site, cookie-consent, privacy, gdpr]
status: proposed
last_verified_at: null
sources:
  - repo://resources/views/layouts/main.blade.php
  - repo://public/js/site.js
  - repo://resources/views/components/footer-bottom-bar-content.blade.php
  - https://www.edpb.europa.eu/sites/default/files/files/file1/edpb_guidelines_202005_consent_en.pdf
  - https://www.faros.eu/images/content/240329-website-softlaw-EDPBcookiebannertaskforcereport.pdf
  - https://zakon.rada.gov.ua/laws/show/2297-17
  - https://itd.rada.gov.ua/billinfo/Bills/Card/40707
---

## Purpose

Give visitors real, revocable control over non-essential cookies before any analytics or marketing script runs, and disclose the actual trackers in use.

## ADDED Requirements

### Requirement: Non-essential scripts wait for consent
Google Analytics, Meta Pixel, Microsoft Clarity and Plerdy MUST NOT load or set any cookie until the visitor has granted consent for the category that covers them (Analytics for GA/Clarity/Plerdy, Marketing for Meta Pixel). Strictly necessary cookies (session, CSRF token, locale) MUST keep working regardless of the visitor's choice.

#### Scenario: First visit, no decision yet
- **WHEN** a visitor loads any public page for the first time
- **THEN** no request to Google Analytics, Meta Pixel, Microsoft Clarity or Plerdy is made
- **AND** the page still functions (session, CSRF, locale switching all work)

#### Scenario: Analytics accepted, marketing rejected
- **WHEN** a visitor accepts the Analytics category only
- **THEN** Google Analytics, Microsoft Clarity and Plerdy load
- **AND** Meta Pixel does not load

### Requirement: Consent banner offers equal, categorized choices
The site MUST show a consent banner before any non-essential script runs. The banner MUST present "Accept all" and "Reject all" as equally prominent actions, and MUST offer a way to customize consent per category: Necessary (always on, not togglable), Analytics, and Marketing. The banner text and controls MUST render in the visitor's resolved locale (en, uk, pl).

#### Scenario: Visitor accepts all
- **WHEN** a visitor clicks "Accept all"
- **THEN** Analytics and Marketing are both granted
- **AND** the banner closes and does not reappear on subsequent page loads

#### Scenario: Visitor rejects all
- **WHEN** a visitor clicks "Reject all"
- **THEN** Analytics and Marketing are both denied
- **AND** the banner closes and does not reappear on subsequent page loads

#### Scenario: Visitor customizes categories
- **WHEN** a visitor opens the customize view and grants only one category, then confirms
- **THEN** only the confirmed category is granted
- **AND** the Necessary category is always shown as active and cannot be turned off

#### Scenario: Localized banner
- **WHEN** the resolved locale is uk or pl
- **THEN** the banner heading, category names and button labels render in that locale, not in English

### Requirement: Consent decision persists and is revocable
The visitor's per-category decision MUST be stored in a first-party cookie readable on subsequent requests, so the banner does not reappear once a decision has been made. The site MUST provide a persistent, always-available "Cookie settings" control that reopens the banner so the visitor can change their decision at any time; a changed decision MUST immediately apply to future script loading.

#### Scenario: Returning visitor with a prior decision
- **WHEN** a visitor who previously chose "Accept all" loads another page
- **THEN** the banner does not reappear
- **AND** Analytics and Marketing scripts load as previously granted

#### Scenario: Visitor changes their mind
- **WHEN** a visitor who previously accepted Analytics opens "Cookie settings" and revokes it
- **THEN** the stored decision is updated to denied for Analytics
- **AND** Analytics scripts do not load on the next page view

### Requirement: Consent is not a precondition for access
The site MUST NOT block or degrade access to page content pending a consent decision (no "cookie wall"). The banner MUST be dismissible via "Reject all" without losing access to any page, and closing or dismissing the banner without making a choice MUST NOT be treated as consent.

#### Scenario: Visitor dismisses without choosing
- **WHEN** a visitor closes the banner without clicking Accept, Reject or Customize
- **THEN** all non-essential categories remain denied
- **AND** the visitor can still read and navigate the full page

### Requirement: Privacy policy discloses actual trackers
The `/privacy-policy` page content MUST list the specific cookies/trackers the site can load (Google Analytics, Meta Pixel, Microsoft Clarity, Plerdy), each with its category (Necessary/Analytics/Marketing), purpose, and approximate retention duration, matching what the consent banner controls.

#### Scenario: Visitor reviews the privacy policy
- **WHEN** a visitor opens `/privacy-policy` in any supported locale
- **THEN** the page content names each tracker, its category, purpose and approximate duration
