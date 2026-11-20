import { expect, test } from '@playwright/test';

const screens: Record<string, string> = {
    saas: 'vetspace-clinic-month',
    business: 'vetspace-clinic-calendar',
    laravel: 'vetspace-admin-plans',
    'api-integrations': 'vetspace-swagger-appointments',
    'php-support': 'digipulse-history',
};

for (const viewport of [{ width: 375, height: 812 }, { width: 1280, height: 900 }]) {
    for (const theme of ['light', 'dark']) {
        test(`showcases load without overflow at ${viewport.width}px in ${theme} mode`, async ({ page }) => {
            await page.setViewportSize(viewport);
            await page.addInitScript((selectedTheme) => localStorage.setItem('saas-theme', selectedTheme), theme);

            for (const [landing, screen] of Object.entries(screens)) {
                await page.goto(`/uk/development/${landing}`);
                const main = page.locator('[data-hero-shot="main"]');
                const image = main.locator('img:visible');

                await expect(image).toHaveCount(1);
                await expect(image).toHaveAttribute('src', new RegExp(`/landing/screens/${screen}(?:-dark)?-800\\.webp$`));
                await expect.poll(() => image.evaluate((img: HTMLImageElement) => img.complete && img.naturalWidth > 0)).toBe(true);
                await expect(main.locator('figcaption')).toBeVisible();
                expect(await page.evaluate(() => document.documentElement.scrollWidth - window.innerWidth)).toBeLessThanOrEqual(0);
            }

            for (const landing of ['symfony', 'php-audit']) {
                await page.goto(`/uk/development/${landing}`);
                await expect(page.locator(`[data-hero-illustration="${landing}"]`)).toBeVisible();
                expect(await page.evaluate(() => document.documentElement.scrollWidth - window.innerWidth)).toBeLessThanOrEqual(0);
            }
        });
    }
}
