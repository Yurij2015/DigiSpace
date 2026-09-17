# public-site/accessibility Specification

## Purpose
Establishes the minimum accessibility contract for the public layout so that screen-reader and keyboard users can identify the brand, social links, search and language controls, and so that no stray characters leak into the navigation.

## Requirements

### Requirement: Images that convey meaning have alternative text
The brand logo images MUST have an `alt` naming the company. Client, technology and widget images MUST have an `alt` derived from the widget/client title; purely decorative images MUST use `alt=""` and MUST NOT be the only content of a link.

#### Scenario: Brand link
- **WHEN** the header is rendered
- **THEN** the logo link contains an image whose `alt` is "DigiSpace" (or the configured site name)

#### Scenario: Client logo
- **WHEN** a client widget with title "Acme" is rendered in the projects carousel
- **THEN** its image has `alt="Acme"`

### Requirement: Icon-only links and buttons have accessible names
Every anchor or button whose visible content is only an icon (header/footer social links, search toggle, search submit, mobile navigation toggle) MUST expose an accessible name via `aria-label` or visually hidden text.

#### Scenario: Social link
- **WHEN** a social icon link is rendered in the header or footer
- **THEN** it has a non-empty `aria-label` describing the network (for example "Facebook") and `rel="noopener"` when it opens a new tab

#### Scenario: Toggles
- **WHEN** the mobile navigation toggle and search toggle are rendered
- **THEN** each has a non-empty `aria-label`

### Requirement: Navigation contains no stray text
The rendered header navigation MUST NOT contain text nodes that are not menu labels (for example a stray `;`), and the home page MUST NOT contain leftover empty mount points (`<div id="app">`).

#### Scenario: Services item with categories
- **WHEN** at least one service category exists and the header is rendered
- **THEN** the Services `<li>` contains only the Services link and the dropdown list, with no other visible text

### Requirement: Language selector is labelled and focus-visible
The language selector MUST have an accessible label in the resolved locale and a visible focus indicator.

#### Scenario: Keyboard focus
- **WHEN** a keyboard user tabs to the language selector
- **THEN** a visible focus outline is shown and the control announces the localized "Language" label
