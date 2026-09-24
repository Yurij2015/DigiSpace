import { defineConfig, devices } from '@playwright/test';

/**
 * E2E tests for the public site. Run inside Sail:
 *   vendor/bin/sail npx playwright test
 * The base URL is the app container's nginx (port 80 on the sail network).
 */
export default defineConfig({
    testDir: './e2e',
    timeout: 60_000,
    fullyParallel: false,
    retries: 0,
    reporter: [['list'], ['html', { open: 'never' }]],
    use: {
        // Inside the Sail container the app is the service hostname; on the host it is the mapped port.
        baseURL: process.env.E2E_BASE_URL ?? (process.env.LARAVEL_SAIL ? 'http://digi-space-app' : 'http://localhost:8100'),
        trace: 'retain-on-failure',
        screenshot: 'only-on-failure',
    },
    projects: [
        { name: 'chromium', use: { ...devices['Desktop Chrome'] } },
    ],
});
