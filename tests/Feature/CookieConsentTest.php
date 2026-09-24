<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class CookieConsentTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    public function test_banner_renders_hidden_with_equal_actions_and_categories(): void
    {
        $this->seedPublicSite();

        $response = $this->get('/en/about');

        $response->assertOk();
        $response->assertSee('id="site-cookie-consent"', false);
        $response->assertSee('role="dialog"', false);
        $response->assertSee('data-consent-accept', false);
        $response->assertSee('data-consent-reject', false);
        $response->assertSee('data-consent-customize', false);
        $response->assertSee('data-consent-dismiss', false);
        $response->assertSee('data-consent-categories', false);
        $response->assertSee('data-consent-category="analytics"', false);
        $response->assertSee('data-consent-category="marketing"', false);
        // Accessibility contract: switches, expanded state, live region.
        $response->assertSee('role="switch"', false);
        $response->assertSee('aria-expanded="false"', false);
        $response->assertSee('data-consent-saved-label', false);
        $response->assertSee('role="status"', false);
        // data-testid attributes are the stable test contract for e2e tests.
        $response->assertSee('data-testid="consent-banner"', false);
        $response->assertSee('data-testid="consent-accept"', false);
        $response->assertSee('data-testid="consent-toggle-analytics"', false);
        $response->assertSee('js/consent.js', false);
    }

    public function test_trackers_are_consent_gated_not_inlined(): void
    {
        $this->seedPublicSite();

        $html = $this->get('/en/about')->assertOk()->getContent();

        // The gtag library tag must not be emitted as a live <script src>; it is injected by the consent callback.
        $this->assertStringNotContainsString('<script async src="https://www.googletagmanager.com', $html);
        // The Meta Pixel noscript fallback would fire without consent for no-JS visitors; it must not be rendered.
        $this->assertStringNotContainsString('facebook.com/tr', $html);
        // Each tracker snippet registers with the consent manager under its category instead of running eagerly.
        $this->assertStringContainsString("DigiConsent.on('analytics'", $html);
        $this->assertStringContainsString("DigiConsent.on('marketing'", $html);
        // Google Consent Mode defaults to denied ahead of any tag injection.
        $this->assertMatchesRegularExpression('/gtag\(.consent., .default.,\s*\{[^}]*analytics_storage.: .denied./s', $html);
        // reCAPTCHA is needed by the contact/subscribe forms and stays unconditional.
        $this->assertStringContainsString('https://www.google.com/recaptcha/api.js', $html);
    }

    public function test_tracker_snippets_are_guarded_and_never_emit_a_broken_pixel_init(): void
    {
        $this->seedPublicSite();

        $html = $this->get('/en/about')->assertOk()->getContent();

        // An unset FACEBOOK_PIXEL_ID used to render `fbq('init', );` - a syntax error that took the
        // whole inline block down with it, so the marketing category silently had no listener.
        $this->assertStringNotContainsString("fbq('init', )", $html);
        // Every tracker sits behind a window.DigiConsent guard, so a blocked or missing consent.js
        // means no tracking rather than a ReferenceError.
        $this->assertSame(
            substr_count($html, 'DigiConsent.on('),
            substr_count($html, '!window.DigiConsent'),
            'every DigiConsent.on() registration must sit behind a window.DigiConsent guard'
        );
        // Analytics has three listeners, so consent.js must start each one individually.
        $this->assertStringContainsString('a.plerdy.com', $html);
        $this->assertStringContainsString('clarity.ms/tag/', $html);
    }

    public function test_footer_exposes_a_cookie_settings_control(): void
    {
        $this->seedPublicSite();

        $this->get('/en/about')
            ->assertOk()
            ->assertSee('data-consent-open', false)
            ->assertSee('data-testid="cookie-settings"', false)
            ->assertSee('aria-haspopup="dialog"', false);
    }

    #[TestWith(['en', 'We use cookies', 'Accept all', 'Reject all'])]
    #[TestWith(['uk', 'Ми використовуємо файли cookie', 'Прийняти все', 'Відхилити все'])]
    #[TestWith(['pl', 'Używamy plików cookie', 'Zaakceptuj wszystkie', 'Odrzuć wszystkie'])]
    public function test_banner_text_is_localized(string $locale, string $title, string $accept, string $reject): void
    {
        $this->seedPublicSite();

        $response = $this->get('/'.$locale.'/about');

        $response->assertOk();
        $response->assertSee($title);
        $response->assertSee($accept);
        $response->assertSee($reject);
    }

    public function test_banner_survives_pages_without_footer_content(): void
    {
        view()->share('headerNavBarContent', null);
        view()->share('footerBottomBarContent', null);

        $response = $this->get('/en/missing-without-chrome');

        $response->assertNotFound();
        // The minimal 404 fallback renders no layout, hence no banner markup — it must not error.
    }
}
