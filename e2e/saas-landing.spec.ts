import { expect, test, type Page } from '@playwright/test';

/**
 * UX checks for the SaaS landing (/{locale}/development/saas) on real phone sizes and on desktop.
 * Layout rules asserted here are the ones a screenshot review is likely to miss: what the cookie bar
 * covers on a first visit, iOS input zoom, horizontal overflow, sticky CTA timing, anchor offsets.
 */

const LANDING = '/uk/development/saas';
const LOCALES = ['uk', 'en', 'pl'];
/** Both landings share one template; layout rules are checked on each of them. */
const LANDINGS = ['saas', 'business'];

const PHONES = [
    { name: 'iPhone SE', width: 375, height: 667 },
    { name: 'Android small', width: 360, height: 800 },
    { name: 'iPhone 14', width: 390, height: 844 },
    { name: 'Pixel 7', width: 412, height: 915 },
];

/** The local debug toolbar is fixed to the bottom edge and would sit on top of the cookie bar. */
async function hideDebugToolbar(page: Page) {
    await page.addStyleTag({ content: '.phpdebugbar, [class*="phpdebugbar"] { display: none !important; }' });
}

async function openLanding(page: Page, path = LANDING) {
    await page.goto(path);
    await hideDebugToolbar(page);
}

/** Smooth scrolling moves for a while after a click: wait until the position stops changing. */
async function waitForScrollEnd(page: Page) {
    await page.evaluate(() => new Promise<void>((resolve) => {
        let last = -1;
        let still = 0;
        const tick = () => {
            still = window.scrollY === last ? still + 1 : 0;
            last = window.scrollY;
            still >= 5 ? resolve() : requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    }));
}

/** Records a decision so the banner is out of the way for tests that are not about it. */
async function dismissConsent(page: Page) {
    await page.getByTestId('consent-reject').click();
    await expect(page.getByTestId('consent-banner')).toBeHidden();
}

for (const phone of PHONES) {
    test.describe(`${phone.name} (${phone.width}×${phone.height})`, () => {
        test.use({
            viewport: { width: phone.width, height: phone.height },
            deviceScaleFactor: 2,
            isMobile: true,
            hasTouch: true,
        });

        test('first visit: the cookie bar is compact and leaves the main CTA uncovered', async ({ page }) => {
          for (const landing of LANDINGS) {
            await openLanding(page, `/pl/development/${landing}`);
            const banner = page.getByTestId('consent-banner');
            await expect(banner).toBeVisible();

            const bannerBox = (await banner.boundingBox())!;
            const ctaBox = (await page.getByTestId('hero-cta').boundingBox())!;

            expect(bannerBox.height, 'cookie bar height').toBeLessThanOrEqual(phone.height * 0.3);
            expect(ctaBox.y + ctaBox.height, 'hero CTA bottom must be above the cookie bar').toBeLessThanOrEqual(bannerBox.y);

            // Both landings keep one primary hero action; Telegram remains in the contact section.
            await expect(page.getByTestId('hero-telegram')).toHaveCount(0);

            // Accept and reject stay equally easy: same row, same size.
            const accept = (await page.getByTestId('consent-accept').boundingBox())!;
            const reject = (await page.getByTestId('consent-reject').boundingBox())!;
            expect(Math.abs(accept.y - reject.y)).toBeLessThan(2);
            expect(Math.abs(accept.width - reject.width)).toBeLessThan(2);
            expect(accept.height).toBeGreaterThanOrEqual(40);
          }
        });

        test('no horizontal scrolling in any locale', async ({ page }) => {
            for (const landing of LANDINGS) {
                for (const locale of LOCALES) {
                    await openLanding(page, `/${locale}/development/${landing}`);
                    const overflow = await page.evaluate(() => document.documentElement.scrollWidth - window.innerWidth);
                    expect(overflow, `${landing}/${locale}: page is wider than the screen`).toBeLessThanOrEqual(0);
                }
            }
        });

        test('hero CTA fits on one line and is a comfortable tap target', async ({ page }) => {
            for (const landing of LANDINGS) {
                for (const locale of LOCALES) {
                    await openLanding(page, `/${locale}/development/${landing}`);
                    const box = (await page.getByTestId('hero-cta').boundingBox())!;
                    expect(box.height).toBeGreaterThanOrEqual(44);
                    expect(box.height, `${landing}/${locale}: label wrapped to a second line`).toBeLessThan(64);
                }
            }
        });

        test('form fields are at least 16px, so iOS does not zoom in on focus', async ({ page }) => {
            await openLanding(page);
            const sizes = await page.locator('#contact form').locator('input:not([type=hidden]), select, textarea')
                .evaluateAll((fields) => fields.map((field) => ({
                    name: (field as HTMLInputElement).name,
                    size: parseFloat(getComputedStyle(field).fontSize),
                })));
            expect(sizes.length).toBe(5);
            for (const field of sizes) {
                expect(field.size, `${field.name} font size`).toBeGreaterThanOrEqual(16);
            }
        });

        test('sticky CTA appears after the hero and hides at the form', async ({ page }) => {
            await openLanding(page);
            await dismissConsent(page);
            const bar = page.locator('[data-sticky-cta]');

            await expect(bar).toHaveAttribute('aria-hidden', 'true');

            await page.locator('#proofs').evaluate((el) => el.scrollIntoView({ behavior: 'instant' }));
            await expect(bar).toHaveAttribute('aria-hidden', 'false');
            // It slides in (300 ms transition): wait for the final position, fully on screen.
            await expect.poll(async () => {
                const box = (await bar.boundingBox())!;
                return box.y + box.height;
            }).toBeLessThanOrEqual(phone.height + 1);
            for (const link of await bar.locator('a').all()) {
                expect((await link.boundingBox())!.height).toBeGreaterThanOrEqual(44);
            }

            await page.locator('#contact').evaluate((el) => el.scrollIntoView({ behavior: 'instant' }));
            await expect(bar).toHaveAttribute('aria-hidden', 'true');
        });
    });
}

test.describe('desktop (1440×900)', () => {
    test.use({ viewport: { width: 1440, height: 900 } });

    test('logo: the D is optically centred on the wordmark capitals, on desktop and on a phone', async ({ page }) => {
        for (const viewport of [{ width: 1440, height: 900 }, { width: 390, height: 844 }]) {
            await page.setViewportSize(viewport);
            await openLanding(page);
            const centres = await page.evaluate(async () => {
                await document.fonts.ready;
                const mark = document.querySelector('[data-logo-mark]')!.getBoundingClientRect();
                const word = document.querySelector('[data-logo-wordmark]') as HTMLElement;
                const style = getComputedStyle(word);
                const ctx = document.createElement('canvas').getContext('2d')!;
                ctx.font = `${style.fontWeight} ${style.fontSize} ${style.fontFamily}`;
                const m = ctx.measureText('DigiSpace');
                const box = word.getBoundingClientRect();
                const baseline = box.top + (box.height - (m.fontBoundingBoxAscent + m.fontBoundingBoxDescent)) / 2 + m.fontBoundingBoxAscent;
                // The D's body starts below its pixel square (7.5 of 48 units).
                const bodyTop = mark.top + (7.5 / 48) * mark.height;
                return { body: (bodyTop + mark.bottom) / 2, capitals: (baseline - m.actualBoundingBoxAscent + baseline) / 2 };
            });
            expect(Math.abs(centres.body - centres.capitals), `${viewport.width}px`).toBeLessThan(0.5);
        }
    });

    test('header CTA leads to the form, like the hero CTA', async ({ page }) => {
        await openLanding(page);
        await expect(page.getByTestId('header-cta')).toHaveAttribute('href', '#contact');
        await expect(page.getByTestId('hero-cta')).toHaveAttribute('href', '#contact');
        await expect(page.getByTestId('inquiry-submit')).toContainText(await page.getByTestId('header-cta').innerText());
    });

    test('nav anchors land below the fixed header', async ({ page }) => {
        await openLanding(page);
        await dismissConsent(page);
        const headerBottom = (await page.locator('header').boundingBox())!.height;

        for (const id of ['proofs', 'guarantees', 'pricing', 'faq']) {
            await page.locator(`header nav a[href="#${id}"]`).click();
            await waitForScrollEnd(page);
            const box = (await page.locator(`#${id} h2`).first().boundingBox())!;
            expect(box.y, `#${id} heading is hidden under the header`).toBeGreaterThanOrEqual(headerBottom);
            expect(box.y, `#${id} heading is not near the top after the jump`).toBeLessThan(400);
        }
    });

    test('pricing cards line up their prices and buttons', async ({ page }) => {
        await openLanding(page);
        const cards = page.locator('#pricing .lg\\:row-span-5');
        await expect(cards).toHaveCount(2);
        const prices = await cards.locator('.text-3xl').evaluateAll((els) => els.map((el) => Math.round(el.getBoundingClientRect().top)));
        const buttons = await cards.locator('a').evaluateAll((els) => els.map((el) => Math.round(el.getBoundingClientRect().top)));
        expect(Math.abs(prices[0] - prices[1])).toBeLessThanOrEqual(1);
        expect(Math.abs(buttons[0] - buttons[1])).toBeLessThanOrEqual(1);
    });

    test('project lightbox pages through the shots with buttons and arrow keys', async ({ page }) => {
        await openLanding(page);
        await dismissConsent(page);
        const dialog = page.locator('[data-gallery-dialog]');
        const caption = dialog.locator('[data-gallery-caption]');

        const opener = page.locator('[data-gallery-open]').nth(1);
        const total = JSON.parse((await opener.getAttribute('data-gallery-items'))!).length;
        expect(total).toBeGreaterThanOrEqual(3);
        await opener.click();
        await expect(dialog).toBeVisible();
        await expect(caption).toContainText(`1 / ${total}`);

        await dialog.locator('[data-gallery-step="1"]').click();
        await expect(caption).toContainText(`2 / ${total}`);
        for (let shot = 3; shot <= total; shot++) {
            await page.keyboard.press('ArrowRight');
            await expect(caption).toContainText(`${shot} / ${total}`);
        }
        await page.keyboard.press('ArrowRight');
        await expect(caption).toContainText(`1 / ${total}`);

        await page.keyboard.press('Escape');
        await expect(dialog).toBeHidden();
    });

    for (const theme of ['light', 'dark']) {
        test(`${theme} theme shows ${theme} screenshots in the cover and the lightbox`, async ({ page }) => {
            await page.addInitScript((value) => localStorage.setItem('saas-theme', value), theme);
            await openLanding(page);
            await dismissConsent(page);

            // VetSpace (second card) has dark twins of its calendar and admin shots.
            const card = page.locator('[data-gallery-open]').nth(1);
            const visibleCover = await card.locator('img').evaluateAll((imgs) =>
                imgs.filter((img) => getComputedStyle(img).display !== 'none').map((img) => (img as HTMLImageElement).src));
            expect(visibleCover).toHaveLength(1);
            expect(visibleCover[0].includes('-dark-'), `cover: ${visibleCover[0]}`).toBe(theme === 'dark');

            await card.click();
            const src = await page.locator('[data-gallery-image]').getAttribute('src');
            expect(src!.includes('-dark.webp'), `lightbox: ${src}`).toBe(theme === 'dark');
            await page.keyboard.press('Escape');
        });
    }

    test('keyboard: the skip link comes first and moves focus to the content', async ({ page }) => {
        await openLanding(page);
        await dismissConsent(page);
        // Closing the banner returns focus to its opener; a fresh load starts from the top of the page.
        await page.reload();
        await page.keyboard.press('Tab');
        const skip = page.getByTestId('skip-link');
        await expect(skip).toBeFocused();
        await expect(skip).toBeVisible();

        await page.keyboard.press('Enter');
        await expect(page.locator('#main')).toBeFocused();
    });

    test('focused links show an outline', async ({ page }) => {
        await openLanding(page);
        await dismissConsent(page);
        await page.reload();
        await page.keyboard.press('Tab'); // skip link
        await page.keyboard.press('Tab'); // logo
        const outline = await page.evaluate(() => {
            const el = document.activeElement as HTMLElement;
            const style = getComputedStyle(el);
            return { tag: el.tagName, width: parseFloat(style.outlineWidth), style: style.outlineStyle };
        });
        expect(outline.tag).toBe('A');
        expect(outline.style).not.toBe('none');
        expect(outline.width).toBeGreaterThanOrEqual(2);
    });

    test('small grey labels keep WCAG AA contrast in the light theme', async ({ page }) => {
        await page.addInitScript(() => localStorage.setItem('saas-theme', 'light'));
        await openLanding(page);

        const ratios = await page.evaluate(() => {
            const parse = (value: string) => (value.match(/[\d.]+/g) ?? []).map(Number);
            const luminance = ([r, g, b]: number[]) => {
                const channel = (c: number) => {
                    const v = c / 255;
                    return v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4;
                };
                return 0.2126 * channel(r) + 0.7152 * channel(g) + 0.0722 * channel(b);
            };
            // First fully opaque background up the tree; translucent tints are treated as white.
            const background = (el: Element | null): number[] => {
                for (let node = el; node; node = node.parentElement) {
                    const rgba = parse(getComputedStyle(node).backgroundColor);
                    if (rgba.length === 3 || (rgba.length === 4 && rgba[3] === 1)) {
                        return rgba.slice(0, 3);
                    }
                }
                return [255, 255, 255];
            };
            const selectors = [
                '[data-testid="hero-cta"] ~ *', // keeps the query list non-empty if markup moves
                'header a span.uppercase',
                'main section:first-of-type .uppercase',
                'footer p',
            ];
            return selectors.flatMap((selector) => Array.from(document.querySelectorAll(selector)))
                .filter((el) => (el as HTMLElement).offsetParent !== null && el.textContent!.trim() !== '')
                .map((el) => {
                    const fg = luminance(parse(getComputedStyle(el).color).slice(0, 3));
                    const bg = luminance(background(el));
                    const ratio = (Math.max(fg, bg) + 0.05) / (Math.min(fg, bg) + 0.05);
                    return { text: el.textContent!.trim().slice(0, 30), ratio: Math.round(ratio * 100) / 100 };
                });
        });

        expect(ratios.length).toBeGreaterThan(3);
        for (const { text, ratio } of ratios) {
            expect(ratio, `"${text}" contrast`).toBeGreaterThanOrEqual(4.5);
        }
    });

    test('reduced motion turns off smooth scrolling', async ({ page }) => {
        await page.emulateMedia({ reducedMotion: 'reduce' });
        await openLanding(page);
        expect(await page.evaluate(() => getComputedStyle(document.documentElement).scrollBehavior)).toBe('auto');
    });
});
