import { expect, test, type Page } from '@playwright/test';

const BANNER = 'consent-banner';
const PANEL = 'consent-categories';
const ACTIONS = 'consent-actions';
const SETTINGS_LINK = 'cookie-settings';

const ANALYTICS_TRACKERS = ['googletagmanager', 'a.plerdy.com', 'clarity.ms/tag'];

async function consentCookie(page: Page) {
    const cookies = await page.context().cookies();
    return cookies.find((cookie: { name: string; }) => cookie.name === 'digi_consent') ?? null;
}

// All three analytics listeners are asserted together: the bug this guards against started one of
// them and silently skipped the rest.
async function expectAnalyticsTrackers(page: Page, loaded: boolean) {
    for (const src of ANALYTICS_TRACKERS) {
        if (loaded) {
            await page.waitForFunction(
                (needle: string) => !!document.querySelector(`script[src*="${needle}"]`),
                src,
            );
        } else {
            expect(
                await page.evaluate((needle) => !!document.querySelector(`script[src*="${needle}"]`), src),
                `${src} must not load without consent`,
            ).toBe(false);
        }
    }
}

test('banner is shown for a new visitor; dismissal records no consent', async ({ page }) => {
    await page.goto('/en/');
    await expect(page.getByTestId(BANNER)).toBeVisible();
    await expect(page.getByTestId(BANNER)).toContainText('We use cookies');

    await page.getByTestId('consent-dismiss').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();
    expect(await consentCookie(page)).toBeNull();

    // Dismissal without a choice is not consent: the banner returns on the next visit.
    await page.goto('/en/about');
    await expect(page.getByTestId(BANNER)).toBeVisible();
});

test('accept all grants everything and loads trackers', async ({ page }) => {
    await page.goto('/en/');
    await expect(page.getByTestId(BANNER)).toBeVisible();

    await page.getByTestId('consent-accept').click();
    // The opening screen has no visible switches to animate, so the decision must be applied
    // synchronously instead of waiting for the category-panel feedback delay.
    expect(await consentCookie(page)).not.toBeNull();
    await expect(page.getByTestId(BANNER)).toBeHidden();

    // Analytics has three listeners - gtag, Plerdy and Clarity - and each has to start on its own.
    await expectAnalyticsTrackers(page, true);
    // The Meta Pixel only loads when FACEBOOK_PIXEL_ID is configured, so the marketing category is
    // asserted through the consent manager instead of through fbq.
    expect(await page.evaluate(() => (window as any).DigiConsent.isGranted('marketing'))).toBe(true);
    await expect(page.getByTestId(SETTINGS_LINK)).toHaveClass(/site-cookie-consent__open--granted/);

    // The decision persists: no banner on the next page.
    await page.goto('/en/about');
    await expect(page.getByTestId(BANNER)).toBeHidden();
    // Regression: a per-category "already started" flag used to run only the first analytics
    // listener on a revisit, leaving Plerdy and Clarity silently dead.
    await expectAnalyticsTrackers(page, true);
});

test('reject all denies optional categories', async ({ page }) => {
    await page.goto('/en/');
    await expect(page.getByTestId(BANNER)).toBeVisible();

    await page.getByTestId('consent-reject').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();
    expect(await consentCookie(page)).not.toBeNull();

    await expect(page.getByTestId(SETTINGS_LINK)).toHaveClass(/site-cookie-consent__open--denied/);
    await page.waitForTimeout(500);
    expect(await page.evaluate(() => typeof (window as any).fbq)).toBe('undefined');
    await expectAnalyticsTrackers(page, false);
});

test('customize allows a partial selection', async ({ page }) => {
    await page.goto('/en/');
    await expect(page.getByTestId(BANNER)).toBeVisible();

    await page.getByTestId('consent-customize').click();
    await expect(page.getByTestId(PANEL)).toBeVisible();
    await expect(page.getByTestId(ACTIONS)).toBeHidden();

    await page.getByTestId('consent-toggle-analytics').check();
    await page.getByTestId('consent-save').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();
    expect(await consentCookie(page)).not.toBeNull();

    await expect(page.getByTestId(SETTINGS_LINK)).toHaveClass(/site-cookie-consent__open--partial/);
    await expectAnalyticsTrackers(page, true);
    expect(await page.evaluate(() => typeof (window as any).fbq)).toBe('undefined');
});

test('cookie settings link reopens prefilled preferences', async ({ page }) => {
    await page.goto('/en/');
    await page.getByTestId('consent-customize').click();
    await page.getByTestId('consent-toggle-analytics').check();
    await page.getByTestId('consent-save').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();

    await page.getByTestId(SETTINGS_LINK).click();
    await expect(page.getByTestId(PANEL)).toBeVisible();
    await expect(page.getByTestId('consent-toggle-analytics')).toBeChecked();
    await expect(page.getByTestId('consent-toggle-marketing')).not.toBeChecked();
});

test('reopen after rejection and accept all upgrades the decision', async ({ page }) => {
    await page.goto('/en/');
    await page.getByTestId('consent-reject').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();
    await expect(page.getByTestId(SETTINGS_LINK)).toHaveClass(/site-cookie-consent__open--denied/);

    // Reopen via the footer link: both toggles reflect the stored "denied" state.
    await page.getByTestId(SETTINGS_LINK).click();
    await expect(page.getByTestId(PANEL)).toBeVisible();
    await expect(page.getByTestId('consent-toggle-analytics')).not.toBeChecked();

    // "Accept all" inside the panel flips everything on and closes the banner.
    await page.getByTestId('consent-panel-accept').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();
    expect(await consentCookie(page)).not.toBeNull();

    expect(await page.evaluate(() => (window as any).DigiConsent.isGranted('marketing'))).toBe(true);
    await expectAnalyticsTrackers(page, true);
    await expect(page.getByTestId(SETTINGS_LINK)).toHaveClass(/site-cookie-consent__open--granted/);
});

test('escape dismisses without consent; aria state stays in sync', async ({ page }) => {
    await page.goto('/en/');
    const settingsLink = page.getByTestId(SETTINGS_LINK);
    const customize = page.getByTestId('consent-customize');

    await expect(page.getByTestId(BANNER)).toHaveAttribute('role', 'dialog');
    await expect(settingsLink).toHaveAttribute('aria-expanded', 'true');

    await customize.click();
    await expect(customize).toHaveAttribute('aria-expanded', 'true');
    await expect(page.getByTestId('consent-toggle-analytics')).toHaveAttribute('role', 'switch');

    // Escape closes without recording a decision, and focus returns to the opener.
    await page.keyboard.press('Escape');
    await expect(page.getByTestId(BANNER)).toBeHidden();
    await expect(settingsLink).toHaveAttribute('aria-expanded', 'false');
    expect(await consentCookie(page)).toBeNull();
});

test('withdrawing analytics drops the trackers that cannot stop in place', async ({ page }) => {
    await page.goto('/en/');
    await page.getByTestId('consent-accept').click();
    await expectAnalyticsTrackers(page, true);

    // Plerdy and Clarity have no in-page off switch, so consent.js reloads the page without them.
    // The marker proves the reload happened rather than a timeout silently passing.
    await page.evaluate(() => { (window as any).__beforeRevoke = true; });
    await page.getByTestId(SETTINGS_LINK).click();
    await page.getByTestId('consent-toggle-analytics').uncheck();
    await page.getByTestId('consent-save').click();
    await page.waitForFunction(() => (window as any).__beforeRevoke === undefined && !!(window as any).DigiConsent);

    expect(await page.evaluate(() => (window as any).DigiConsent.isGranted('analytics'))).toBe(false);
    expect(await page.evaluate(() => (window as any).DigiConsent.isGranted('marketing'))).toBe(true);
    await expectAnalyticsTrackers(page, false);
    await expect(page.getByTestId(SETTINGS_LINK)).toHaveClass(/site-cookie-consent__open--partial/);
});

// The banner is shared by the main site and the landings. With the preferences panel open, resizing
// the window across the 575px breakpoint (card ↔ full-width bar) and down to a short landscape screen
// must keep it inside the viewport, without horizontal scroll, and with "Save" reachable.
for (const path of ['/en/', '/pl/development/business']) {
    test(`open preferences survive window resizing on ${path}`, async ({ page }) => {
        await page.setViewportSize({ width: 1440, height: 900 });
        await page.goto(path);
        await page.addStyleTag({ content: '.phpdebugbar, [class*="phpdebugbar"] { display: none !important; }' });
        await page.getByTestId('consent-customize').click();
        await expect(page.getByTestId(PANEL)).toBeVisible();

        const sizes = [
            { width: 1440, height: 900 },
            { width: 576, height: 800 },
            { width: 575, height: 800 },
            { width: 400, height: 700 },
            { width: 320, height: 568 },
            { width: 900, height: 400 },
            { width: 1280, height: 720 },
        ];
        for (const size of sizes) {
            await page.setViewportSize(size);
            const state = await page.getByTestId(BANNER).evaluate((banner) => {
                const rect = banner.getBoundingClientRect();
                const save = banner.querySelector('[data-testid="consent-save"]') as HTMLElement;
                const scrollTop = banner.scrollTop;
                banner.scrollTop = banner.scrollHeight;
                const saveRect = save.getBoundingClientRect();
                banner.scrollTop = scrollTop;
                return {
                    top: rect.top,
                    bottom: rect.bottom,
                    pageOverflowX: document.documentElement.scrollWidth - window.innerWidth,
                    bannerOverflowX: banner.scrollWidth - banner.clientWidth,
                    saveReachable: saveRect.top >= 0 && saveRect.bottom <= window.innerHeight,
                };
            });
            const label = `${size.width}×${size.height}`;
            await expect(page.getByTestId(PANEL), label).toBeVisible();
            expect(state.top, `${label}: banner starts above the viewport`).toBeGreaterThanOrEqual(0);
            expect(state.bottom, `${label}: banner ends below the viewport`).toBeLessThanOrEqual(size.height + 1);
            expect(state.pageOverflowX, `${label}: page scrolls sideways`).toBeLessThanOrEqual(0);
            expect(state.bannerOverflowX, `${label}: banner scrolls sideways`).toBeLessThanOrEqual(0);
            expect(state.saveReachable, `${label}: "Save" cannot be reached`).toBe(true);
        }
    });
}

test('new relic runs for everyone and writes no first-party cookie', async ({ page }) => {
    await page.goto('/en/');
    await page.getByTestId('consent-reject').click();
    await expect(page.getByTestId(BANNER)).toBeHidden();

    // The agent still runs for every visitor - that is the point of keeping it out of the banner.
    expect(await page.evaluate(() => typeof (window as any).NREUM)).toBe('object');
    expect(await page.evaluate(() => (window as any).NREUM.init.privacy.cookies_enabled)).toBe(false);

    // cookies_enabled:false stops the agent writing on our own domain. It does not reach the
    // JSESSIONID that New Relic's beacon host sets on .nr-data.net from its own HTTP response -
    // that is a third-party cookie we cannot switch off from here, only avoid by not beaconing.
    const firstPartyHost = new URL(page.url()).hostname;
    const ours = (await page.context().cookies()).filter(
        (cookie) => cookie.domain.replace(/^\./, '') === firstPartyHost,
    );
    expect(ours.map((cookie) => cookie.name).sort()).toEqual(
        ['PHPDEBUGBAR_STACK_DATA', 'XSRF-TOKEN', 'digi_consent', 'digispace_session'].sort(),
    );
});
