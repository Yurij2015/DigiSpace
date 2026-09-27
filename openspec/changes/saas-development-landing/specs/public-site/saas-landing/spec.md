## Purpose

Provides a dedicated multilingual landing page for SaaS MVP development, custom web application architecture and B2B automation clients, with a local focus on Poznań and Wielkopolska and reach across Poland and Europe. It is organized under the `development` service group and backed by live in-house production platforms.

## ADDED Requirements

### Requirement: Dedicated multilingual SaaS landing route under development group
The system SHALL provide a dedicated public route at `/{locale}/development/saas` (named `development.saas`) for all supported application locales (`uk`, `pl`, `en`), resolving localized copy, canonical meta tags, hreflang alternates and OpenGraph headers.

#### Scenario: Resolving localized landing page in Ukrainian
- **WHEN** a visitor navigates to `/uk/development/saas`
- **THEN** the system renders the SaaS development landing page with Ukrainian copy and a canonical URL pointing to `/uk/development/saas`

#### Scenario: Resolving localized landing page in Polish
- **WHEN** a visitor navigates to `/pl/development/saas`
- **THEN** the system renders the SaaS development landing page with Polish copy and a canonical URL pointing to `/pl/development/saas`

#### Scenario: Resolving localized landing page in English
- **WHEN** a visitor navigates to `/en/development/saas`
- **THEN** the system renders the SaaS development landing page with English copy and a canonical URL pointing to `/en/development/saas`

#### Scenario: Landing page is listed in the sitemap
- **WHEN** `sitemap:generate` runs
- **THEN** the sitemap contains `/{locale}/development/saas` for every supported locale with hreflang alternates and an `x-default`

### Requirement: Isolated asset pipeline and clean minimal layout
The landing page SHALL render using a dedicated layout and an isolated Tailwind CSS bundle that scans only the landing templates, preventing legacy DigiSpace CSS and the admin Tailwind configuration from affecting the page.

#### Scenario: Rendering with dedicated asset bundle
- **WHEN** a visitor inspects the HTML `<head>` on `/{locale}/development/saas`
- **THEN** the page includes only the dedicated `landing-saas.css` Vite asset and does NOT link legacy global stylesheets (`site.css`, `app.css` or template theme files)

#### Scenario: Responsive presentation
- **WHEN** a visitor views the landing page on mobile (375px) or desktop (1440px)
- **THEN** the page has no horizontal scroll, text stays readable and the header does not wrap

### Requirement: Light and dark themes selected by the visitor
The landing page SHALL support a light and a dark theme. Without an explicit choice, the theme SHALL follow the operating system preference; a header toggle SHALL switch the theme and remember the choice in the visitor's browser.

#### Scenario: First visit follows the OS preference
- **WHEN** a visitor with a dark OS color scheme opens the page for the first time
- **THEN** the page renders in the dark theme before first paint (no flash of the light theme)

#### Scenario: Explicit choice is remembered
- **WHEN** a visitor switches the theme with the header toggle and reloads the page
- **THEN** the chosen theme is applied regardless of the OS preference

#### Scenario: Native controls and embedded widgets match the theme
- **WHEN** the page renders in the dark theme
- **THEN** native form controls use the dark color scheme and the reCAPTCHA widget is rendered with its dark theme

### Requirement: In-house SaaS production platforms as proof of work
The landing page SHALL showcase DigiSpace's own live systems (`DigiPulse`, `VetSpace & VetCard`, `NetPostPanel`) with architecture highlights, technology badges and live external links. Illustrations SHALL NOT show invented metrics or figures presented as real data, and the page SHALL NOT link to repositories that are not the project's own public repository.

#### Scenario: Displaying live SaaS system details
- **WHEN** a visitor reviews the projects section
- **THEN** each card displays the platform's role, its stack and an external link to the live application

#### Scenario: Displaying client feedback
- **WHEN** a visitor reviews the social proof section
- **THEN** two compact cards show verbatim excerpts from the Upwork client review and the LinkedIn recommendation, omissions are marked with "…", each card names its source (the LinkedIn one links to the profile), non-English locales mark the text as a translation, and no rating, role or claim absent from the source is added

### Requirement: SaaS MVP building blocks and 4-sprint delivery plan
The landing page SHALL explain the building blocks of a typical SaaS MVP and outline a 4-sprint delivery plan from database design to production deployment.

#### Scenario: Inspecting MVP building blocks
- **WHEN** a visitor reads the "what's included" section
- **THEN** the page shows six blocks: multi-tenancy, Stripe subscriptions, background jobs, Filament admin panel, AI/RAG features, Docker deployment, and states that the set is agreed per project

#### Scenario: Inspecting the delivery plan
- **WHEN** a visitor evaluates the delivery process
- **THEN** four two-week sprints (architecture & foundation, core features & payments, user area & admin panel, testing & launch) are listed with their deliverables

### Requirement: Transparent delivery commitments without absolute guarantees
The landing page SHALL state its delivery commitments consistently across all sections: a password-protected test server available in the first week, and automated tests (Unit and Playwright E2E) run on every push. The copy SHALL NOT promise the absence of bugs or regressions.

#### Scenario: Reviewing test server availability
- **WHEN** a visitor reads the hero metrics, working rules, comparison table, sprint plan and pricing
- **THEN** every mention of the test server gives the same timing: the first week

#### Scenario: Reviewing automated quality assurance
- **WHEN** a visitor reads about testing
- **THEN** the page describes unit tests for business logic and billing and Playwright tests for sign-up, onboarding and payment, framed as reducing the risk of regressions rather than eliminating them

### Requirement: Direct collaboration and code ownership, compared neutrally
The landing page SHALL describe direct collaboration with the developer who writes the code and full ownership of code and infrastructure on the client's cloud. The comparison with a typical agency SHALL use neutral wording without disparaging claims.

#### Scenario: Evaluating cooperation terms
- **WHEN** a visitor reviews the working rules and comparison table
- **THEN** the page states direct access to the senior developer, deployment to the client's cloud (Hetzner, AWS, DigitalOcean) and commits to the client's repository from day one, while the agency column uses neutral descriptions (e.g. "Depends on the contract")

### Requirement: Local positioning for Poznań and Wielkopolska
The landing page SHALL communicate that DigiSpace is based in Poznań, can meet clients from Poznań and Wielkopolska in person, and works remotely with clients from the rest of Poland and abroad.

#### Scenario: Local signals in copy and metadata
- **WHEN** a visitor or search engine reads the page
- **THEN** Poznań appears in the SEO title, meta description, hero, header and footer, the FAQ contains a question about working with companies from Poznań and Wielkopolska, and the JSON-LD declares `addressLocality: Poznań`, `addressRegion: Wielkopolskie` and `areaServed` including Poznań, Wielkopolskie, Poland and the European Union

### Requirement: No tracking without a consent mechanism
Because the landing layout does not include the site's cookie consent banner, the landing page SHALL NOT load analytics or marketing trackers (Meta Pixel, Google Analytics).

#### Scenario: Inspecting third-party scripts
- **WHEN** the landing page is rendered
- **THEN** its HTML contains no Meta Pixel (`fbevents.js`) or Google Analytics (`googletagmanager`) scripts

### Requirement: Founder contact and spam-protected inquiry form with lead source
The landing page SHALL offer contact via Telegram, email and a short inquiry form. The form SHALL be protected by reCAPTCHA and rate limiting, store the inquiry in `contact_forms` with `source = development-saas`, and push it to Zoho CRM as a lead.

#### Scenario: Initiating Telegram contact
- **WHEN** a visitor clicks the Telegram action
- **THEN** the link opens `https://t.me/YuriiMokryi` in a new tab

#### Scenario: Submitting a valid inquiry
- **WHEN** a visitor submits name/company, contact, description and a valid reCAPTCHA
- **THEN** a `contact_forms` row is stored with `source = development-saas`, the lead is sent to Zoho CRM, and the visitor is redirected back to `#contact` with a localized success message

#### Scenario: Optional stage and budget
- **WHEN** a visitor leaves the stage and budget selects at their default
- **THEN** the default option is "not specified" (an empty value), and the stored message records them as not specified

#### Scenario: Telegram handle as contact
- **WHEN** the contact value is not an email address
- **THEN** `email` and `phone` stay empty and the contact appears only in the stored message

#### Scenario: Rejected inquiry
- **WHEN** required fields or the reCAPTCHA are missing, or stage/budget hold unknown values
- **THEN** no lead is stored and the form shows localized validation errors

### Requirement: Lead source recorded for every contact form
Every lead stored in `contact_forms` SHALL record the page it came from in the `source` column.

#### Scenario: Main contact page lead
- **WHEN** a visitor submits the main contact form at `/{locale}/contact-us`
- **THEN** the stored row has `source = contact-us`

#### Scenario: Historical rows
- **WHEN** the migration runs on an existing database
- **THEN** rows stored before source tracking keep `source = NULL`
