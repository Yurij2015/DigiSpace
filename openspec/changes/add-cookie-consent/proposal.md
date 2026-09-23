## Why

The public site loads Google Analytics, Meta Pixel, Microsoft Clarity and Plerdy unconditionally on every page load, with no consent mechanism and no cookie-specific disclosure. This does not meet GDPR/ePrivacy requirements, which apply extraterritorially to the site's EU (Polish-locale) visitors regardless of where the business is registered (GDPR Art. 3(2)). Ukraine's current data protection law (No. 2297-VI) does not yet regulate cookies specifically, but the pending draft law No. 8153 (Art. 17, in progress toward its second reading) would impose GDPR-equivalent tracking-consent rules. Adopting the GDPR-grade opt-in flow now closes the EU gap and anticipates the Ukrainian bill instead of maintaining two different behaviors per locale. A compliant opt-in consent banner is needed before these trackers may run.

## What Changes

- Add a cookie consent banner shown on first visit, with equally-prominent "Accept all" and "Reject all" actions plus a "Customize" option exposing three categories: Necessary (always on), Analytics (GA, Clarity, Plerdy), and Marketing (Meta Pixel).
- Block Google Analytics, Meta Pixel, Microsoft Clarity and Plerdy from loading until the visitor grants consent for their category; Necessary-only cookies (session, CSRF, locale) always function.
- Persist the visitor's choice (per category, with a timestamp) in a first-party cookie read on every request, so the banner does not reappear after a decision and consent is respected on subsequent page loads without re-prompting.
- Add a persistent "Cookie settings" control (e.g. in the footer) that reopens the banner so visitors can change their decision at any time.
- Update the `/privacy-policy` CMS content to list the actual cookies/trackers in use (name, purpose, category, approximate duration) so the disclosure matches what the banner controls.
- Render the banner and its labels in the visitor's resolved locale (en/uk/pl), consistent with existing localized-UI conventions.

## Capabilities

### New Capabilities
- `public-site/cookie-consent`: Consent banner behavior, per-category script gating, consent persistence, and the "Cookie settings" re-open control.

### Modified Capabilities
None. No existing capability's specified requirements change; `public-site/localized-ui` already requires site-authored UI text to render in the resolved locale, and the new banner follows that existing requirement rather than changing it.

## Impact

Public Blade layout (`resources/views/layouts/main.blade.php`), a new consent-manager JS module served like the existing `public/js/site.js`, footer component (`resources/views/components/footer-bottom-bar-content.blade.php` or equivalent), locale dictionaries (`lang/{en,uk,pl}/site.php`), and the `/privacy-policy` CMS page content. No backend consent storage, no database migration, no dependency changes, no changes to legacy `/admin` routes. The implementation is explicitly requested together with this OpenSpec change.
