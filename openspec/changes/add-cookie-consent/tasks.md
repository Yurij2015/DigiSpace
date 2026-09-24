## 1. Consent manager foundation

- [x] 1.1 Add `public/js/consent.js` implementing cookie read/write (`digi_consent` JSON cookie: necessary/analytics/marketing/ts) and `window.DigiConsent` with `on(category, callback)`, `grant(categories)`, `open()`, and re-running queued callbacks for categories already granted on load; verify with a manual browser check that the cookie is written on accept/reject and callbacks fire only for granted categories.
- [x] 1.2 Add `resources/views/components/cookie-consent.blade.php` banner partial (heading, description, Accept all / Reject all / Customize actions, per-category toggles with Necessary locked on) using `__('site.*')` strings; include it once from `layouts/main.blade.php`, hidden by default via CSS; verify the partial renders on any public page without JS errors.
- [x] 1.3 Add `.site-cookie-consent*` styles to `public/css/site.css` for the banner and toggle controls, following the existing `.site-language-control__*` component style; verify the banner is visually usable at mobile and desktop widths.

## 2. Locale content

- [x] 2.1 Add banner/category/button strings and a "Cookie settings" label to `lang/en/site.php`, `lang/uk/site.php` and `lang/pl/site.php`; verify each locale renders its own text by loading `/en`, `/uk`, `/pl` and inspecting the banner.

## 3. Gate the trackers

- [x] 3.1 Wrap the Meta Pixel snippet in `layouts/main.blade.php` in a loader function registered as `marketing` with `DigiConsent.on`; verify via browser network tab that no request to `connect.facebook.net`/`facebook.com/tr` happens before consent and one happens right after granting Marketing.
- [x] 3.2 Add the Google Consent Mode v2 default-denied `gtag('consent', 'default', {...})` call as the first inline script in `<head>` (ahead of any tag injection), then wrap the Google gtag library snippet in a loader function registered as `analytics` that injects the library and calls `gtag('consent', 'update', {analytics_storage: 'granted', ...})`; verify no request to `googletagmanager.com` happens before consent and one happens right after granting Analytics, and that granting/revoking Analytics via "Cookie settings" issues a corresponding `consent update` call when the library is already loaded.
- [x] 3.3 Wrap the Plerdy snippet in a loader function registered as `analytics`; verify no request to `a.plerdy.com` happens before consent and one happens right after granting Analytics.
- [x] 3.4 Wrap the Microsoft Clarity snippet in a loader function registered as `analytics`; verify no request to `clarity.ms` happens before consent and one happens right after granting Analytics.
- [x] 3.5 Confirm the reCAPTCHA script tag (needed for the contact/subscribe forms) and any strictly necessary behavior are left loading unconditionally; verify the contact form still submits and reCAPTCHA still renders with no consent decision made.

## 4. Settings control and persistence

- [x] 4.1 Add a "Cookie settings" button to `resources/views/components/footer-bottom-bar-content.blade.php` next to the Privacy Policy/FAQ/Support links, calling `DigiConsent.open()`; verify it reopens the banner pre-filled with the visitor's current per-category choice.
- [x] 4.2 Verify a returning visitor with an existing `digi_consent` cookie does not see the banner on load and that previously granted categories' scripts load automatically (manual check: set cookie, reload, inspect network tab).
- [x] 4.3 Verify changing a category via "Cookie settings" updates the cookie and immediately affects whether that category's scripts load on the next page view.

## 5. Privacy policy content and verification

- [x] 5.1 Update the `privacy-policy` `Page` content (via the existing admin UI, all three locales) to list Google Analytics, Meta Pixel, Microsoft Clarity and Plerdy with category, purpose and approximate duration; verify by loading `/privacy-policy` in each locale and confirming all four trackers are named.
- [x] 5.2 Run `PublicSeoTest` and `LocalizedChromeTest` (and the full PHPUnit suite) to confirm the layout/footer changes do not regress existing metadata or localized-chrome behavior; run Pint (`vendor/bin/sail bin pint --dirty --format agent`) and `git diff --check`; record outcomes and complete this task checklist.
