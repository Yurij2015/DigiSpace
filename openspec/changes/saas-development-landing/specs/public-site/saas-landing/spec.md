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
- **THEN** each card displays the platform's role, its stack and an external link: the live application for DigiPulse and VetSpace, and the descriptive repository for NetPostPanel, which is not a public product

#### Scenario: Browsing product screenshots
- **WHEN** a visitor reaches a project card
- **THEN** the card shows one real product screenshot as its cover with the number of available shots; clicking it opens a lightbox that pages through all of the project's screenshots (buttons and arrow keys) with localized captions and a counter, and no screenshot exposes real customer data (monitored site names, domains, IPs and personal e-mails are blurred; demo clinic data is labelled as demo)

#### Scenario: Displaying client feedback
- **WHEN** a visitor reviews the social proof section
- **THEN** two compact cards show verbatim excerpts from the Upwork client review and the LinkedIn recommendation, omissions are marked with "…", each card names its source (the LinkedIn one links to the profile), non-English locales mark the text as a translation, and no rating, role or claim absent from the source is added

### Requirement: One "how we work" block with rules, plan and building blocks
The landing page SHALL present its working rules, a 4-sprint delivery plan and the building blocks of a typical SaaS MVP in a single "how we work" section, stating each promise once, and end the section with a call to action to the form.

#### Scenario: Inspecting MVP building blocks
- **WHEN** a visitor reads the "how we work" section
- **THEN** the page lists six building blocks as short labels (multi-tenancy, Stripe subscriptions, background jobs, Filament admin panel, AI/RAG features, Docker and deployment) and states that the set is agreed per project

#### Scenario: Inspecting the delivery plan
- **WHEN** a visitor evaluates the delivery process
- **THEN** four stages of up to two weeks (architecture & foundation, core features & payments, user area & admin panel, testing & launch) are shown with their weeks and a one-line result each, and the copy explains that a smaller scope shortens the stages to a 6-week launch, so the plan matches the "6–8 weeks" promise

### Requirement: Transparent delivery commitments without absolute guarantees
The landing page SHALL state its delivery commitments consistently across all sections: a password-protected test server available in the first week, and automated tests (Unit and Playwright E2E) run on every push. The copy SHALL NOT promise the absence of bugs or regressions.

#### Scenario: Reviewing test server availability
- **WHEN** a visitor reads the working rules, sprint plan and pricing
- **THEN** every mention of the test server gives the same timing: the first week

#### Scenario: Reviewing automated quality assurance
- **WHEN** a visitor reads about testing
- **THEN** the page describes unit tests for business logic and billing and Playwright tests for sign-up, onboarding and payment, framed as reducing the risk of regressions rather than eliminating them

### Requirement: Direct collaboration and code ownership, compared neutrally
The landing page SHALL describe direct collaboration with the developer who writes the code and full ownership of code and infrastructure on the client's cloud. The comparison with a typical agency SHALL be a single neutral line under the prices, without disparaging claims.

#### Scenario: Evaluating cooperation terms
- **WHEN** a visitor reviews the working rules and pricing
- **THEN** the page states direct access to the senior developer, deployment to the client's cloud (Hetzner, AWS, DigitalOcean) and commits to the client's repository from day one, and one line under the prices explains without unverifiable figures why an MVP from one senior developer costs less than an agency team

### Requirement: Local positioning for Poznań and Wielkopolska
The landing page SHALL communicate that DigiSpace is based in Stęszew near Poznań, can meet clients from Poznań and Poznań County in person, and works remotely with clients from the rest of Poland and abroad.

#### Scenario: Local signals in copy and metadata
- **WHEN** a visitor or search engine reads the page
- **THEN** Poznań appears in the SEO title, meta description and hero, the footer and founder block name Stęszew near Poznań, the FAQ answers whether we work with companies from Poznań and the surrounding area (naming towns of Poznań County), and the JSON-LD declares `addressLocality: Stęszew`, `addressRegion: Wielkopolskie` and `areaServed` including Poznań, Stęszew, Poznań County, Wielkopolskie, Poland and the European Union

### Requirement: Consent-gated tracking and conversion events
The landing page SHALL use the site's shared cookie banner and SHALL load analytics and marketing trackers (GA4, Microsoft Clarity, Meta Pixel) only after the visitor grants the matching category. Conversion events SHALL be sent only under that consent.

#### Scenario: No trackers before consent
- **WHEN** a visitor without a stored decision opens the landing page
- **THEN** the cookie banner is shown, Consent Mode defaults deny all storage, and no GA4, Clarity or Meta Pixel script is requested

#### Scenario: Trackers after consent
- **WHEN** the visitor accepts Analytics (and Marketing)
- **THEN** GA4 and Clarity load (and the Meta Pixel loads when a pixel ID is configured)

#### Scenario: Interest and lead events
- **WHEN** a consenting visitor clicks a Telegram or e-mail link, or lands on the page after a stored inquiry
- **THEN** GA4 receives `contact` (with the method) or `generate_lead`, and the Meta Pixel receives `Contact` or `Lead`

#### Scenario: Changing the decision later
- **WHEN** a visitor uses the "Cookie settings" control in the landing footer
- **THEN** the banner reopens and the decision can be changed or revoked

### Requirement: Founder contact and spam-protected inquiry form with lead source
The landing page SHALL offer contact via Telegram, email and a short inquiry form. The form SHALL be protected by invisible reCAPTCHA v3 (successful verification, matching action and a minimum score) and rate limiting, store the inquiry in `contact_forms` with `source = development-saas`, and push it to Zoho CRM as a lead.

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
- **WHEN** required fields are missing, the reCAPTCHA token is missing, scores below the threshold or was issued for another action, or stage/budget hold unknown values
- **THEN** no lead is stored and the form shows localized validation errors

### Requirement: Lead source recorded for every contact form
Every lead stored in `contact_forms` SHALL record the page it came from in the `source` column.

#### Scenario: Main contact page lead
- **WHEN** a visitor submits the main contact form at `/{locale}/contact-us`
- **THEN** the stored row has `source = contact-us`

#### Scenario: Historical rows
- **WHEN** the migration runs on an existing database
- **THEN** rows stored before source tracking keep `source = NULL`

### Requirement: Conversion path and page performance
The landing page SHALL work as a short funnel — hero, projects, founder with reviews, how we work, pricing, FAQ, form — with the price anchor in the hero, keep a call to action within reach on mobile, show social proof before pricing, and avoid loading third-party resources that are not needed for the first view.

#### Scenario: Mobile sticky call to action
- **WHEN** a mobile visitor scrolls past the hero
- **THEN** a sticky "Discuss a project" button linking to `#contact` is shown, and it hides while the form or footer is visible

#### Scenario: Price anchor in the hero
- **WHEN** a visitor sees the first screen
- **THEN** the hero trust bar shows the MVP starting price (net) next to the timeline and code ownership

#### Scenario: Short funnel in a fixed order
- **WHEN** the page renders
- **THEN** the sections appear in the order projects, founder with reviews, how we work, pricing, FAQ, contact, and there is no separate comparison table

#### Scenario: Reviews before pricing
- **WHEN** the page renders
- **THEN** the reviews appear after the projects section and before the pricing section

#### Scenario: Self-hosted fonts and deferred reCAPTCHA
- **WHEN** the page loads
- **THEN** no request goes to Google Fonts, Ukrainian text uses the bundled Cyrillic font, and the reCAPTCHA script is requested only when the visitor approaches or focuses the form

#### Scenario: FAQ structured data
- **WHEN** a search engine reads the page
- **THEN** a `FAQPage` JSON-LD block lists every FAQ question with its answer in the page locale

#### Scenario: Form privacy notice
- **WHEN** a visitor views the inquiry form
- **THEN** a short notice names DigiSpace as the data controller, states the purpose (replying to the inquiry) and links to the privacy policy
