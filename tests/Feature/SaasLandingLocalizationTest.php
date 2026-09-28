<?php

namespace Tests\Feature;

use App\Models\ContactForm;
use App\Services\ZohoLeadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\TestCase;

class SaasLandingLocalizationTest extends TestCase
{
    use RefreshDatabase;

    private float $recaptchaScore = 0.9;

    private string $recaptchaAction = 'saas_inquiry';

    private const LANDING = '/en/development/saas';

    private const INQUIRY = '/en/development/saas-inquiry';

    private const VALID = [
        'project_name' => 'Acme',
        'contact' => 'founder@acme.test',
        'stage' => 'idea',
        'budget' => 'sprint',
        'description' => 'Booking SaaS for dental clinics.',
        'g-recaptcha-response' => 'token',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.recaptcha_v3.site_key' => 'test-site-key', 'services.recaptcha_v3.secret_key' => 'test-secret']);
        // Read at request time, so a test can change the verdict before posting.
        Http::fake(['www.google.com/recaptcha/*' => fn () => Http::response([
            'success' => true,
            'score' => $this->recaptchaScore,
            'action' => $this->recaptchaAction,
        ])]);
    }

    public function test_saas_dictionary_has_full_key_parity_across_all_locales(): void
    {
        $locales = config('locales.supported');
        $this->assertNotEmpty($locales);

        $dictionaries = [];
        foreach ($locales as $locale) {
            $path = base_path("lang/{$locale}/saas.php");
            $this->assertFileExists($path, "Translation file missing for locale: {$locale}");
            $dictionaries[$locale] = Arr::dot(require $path);
        }

        $enKeys = array_keys($dictionaries['en']);
        sort($enKeys);

        foreach ($locales as $locale) {
            if ($locale === 'en') {
                continue;
            }

            $currentKeys = array_keys($dictionaries[$locale]);
            sort($currentKeys);

            $missingInCurrent = array_diff($enKeys, $currentKeys);
            $extraInCurrent = array_diff($currentKeys, $enKeys);

            $this->assertEmpty(
                $missingInCurrent,
                "Locale '{$locale}' is missing keys present in 'en': ".implode(', ', $missingInCurrent)
            );

            $this->assertEmpty(
                $extraInCurrent,
                "Locale '{$locale}' has extra keys not present in 'en': ".implode(', ', $extraInCurrent)
            );

            // Verify non-empty values
            foreach ($dictionaries[$locale] as $key => $value) {
                if (is_string($value)) {
                    $this->assertNotEmpty(
                        trim($value),
                        "Locale '{$locale}' key '{$key}' has empty string value"
                    );
                }
            }
        }
    }

    public function test_saas_landing_page_renders_successfully_for_all_supported_locales(): void
    {
        $locales = config('locales.supported');

        foreach ($locales as $locale) {
            $response = $this->get(route('development.saas', ['locale' => $locale]));
            $response->assertOk();
            $response->assertViewIs('development.landing');

            $html = $response->getContent();

            // A missing translation renders its raw key.
            $this->assertDoesNotMatchRegularExpression('/>\s*(saas|site)\.[a-z_.]+\s*</', $html);

            // Isolated layout: the legacy theme stylesheet must not leak in.
            $this->assertStringNotContainsString('css/site.css', $html);

            // Assert canonical tag points to this route
            $this->assertStringContainsString('rel="canonical"', $html);
            $this->assertStringContainsString('/'.$locale.'/development/saas', $html);

            // Assert in-house proof of work projects are present
            $this->assertStringContainsString('DigiPulse', $html);
            $this->assertStringContainsString('VetSpace', $html);
            $this->assertStringContainsString('NetPostPanel', $html);

            // Assert key section anchors exist
            $this->assertStringContainsString('id="proofs"', $html);
            $this->assertStringContainsString('id="engine"', $html);
            $this->assertStringContainsString('id="guarantees"', $html);
            $this->assertStringContainsString('id="process"', $html);
            $this->assertStringContainsString('id="pricing"', $html);
            $this->assertStringContainsString('id="faq"', $html);
            $this->assertStringContainsString('id="contact"', $html);
        }
    }

    public function test_saas_inquiry_validates_required_fields(): void
    {
        $response = $this->post(route('development.saas.inquiry', ['locale' => 'en']), []);

        $response->assertSessionHasErrors(['project_name', 'contact', 'description', 'g-recaptcha-response']);
        $this->assertDatabaseCount('contact_forms', 0);
    }

    public function test_rejected_inquiry_returns_to_the_form_with_localized_messages(): void
    {
        $this->from('/uk/development/saas')
            ->post('/uk/development/saas-inquiry', ['description' => ''] + self::VALID)
            ->assertRedirect('/uk/development/saas#contact')
            ->assertSessionHasErrors(['description' => 'Заповніть поле «Короткий опис продукту».']);
    }

    public function test_saas_inquiry_rejects_a_low_recaptcha_score(): void
    {
        $this->fakeRecaptcha(0.1, 'saas_inquiry');

        $this->post(self::INQUIRY, self::VALID)->assertSessionHasErrors('g-recaptcha-response');
        $this->assertDatabaseCount('contact_forms', 0);
    }

    public function test_saas_inquiry_rejects_a_token_minted_for_another_action(): void
    {
        $this->fakeRecaptcha(0.9, 'login');

        $this->post(self::INQUIRY, self::VALID)->assertSessionHasErrors('g-recaptcha-response');
        $this->assertDatabaseCount('contact_forms', 0);
    }

    private function fakeRecaptcha(float $score, string $action): void
    {
        $this->recaptchaScore = $score;
        $this->recaptchaAction = $action;
    }

    public function test_saas_inquiry_rejects_unknown_stage_and_budget(): void
    {
        $this->post(self::INQUIRY, ['stage' => 'enterprise', 'budget' => 'unlimited'] + self::VALID)
            ->assertSessionHasErrors(['stage', 'budget']);
    }

    public function test_saas_inquiry_is_stored_with_its_source_and_pushed_to_zoho(): void
    {
        $this->mock(ZohoLeadService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendLead')->once()->withArgs(
                fn (array $lead) => $lead['source'] === ContactForm::SOURCE_SAAS_LANDING
                    && $lead['email'] === 'founder@acme.test'
                    && str_contains($lead['message'], 'Booking SaaS for dental clinics.')
            );
        });

        $this->from(self::LANDING)
            ->post(self::INQUIRY, self::VALID)
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::LANDING.'#contact')
            ->assertSessionHas('saas_success', true);

        $this->assertDatabaseHas('contact_forms', [
            'name' => 'Acme',
            'email' => 'founder@acme.test',
            'phone' => null,
            'source' => ContactForm::SOURCE_SAAS_LANDING,
        ]);
    }

    public function test_lead_event_is_emitted_only_after_a_successful_inquiry(): void
    {
        $this->assertStringNotContainsString("'generate_lead'", $this->get(self::LANDING)->getContent());

        $this->withSession(['saas_success' => true])
            ->get(self::LANDING)
            ->assertOk()
            ->assertSee("'generate_lead'", false)
            ->assertSee("fbq('track', 'Lead'", false);
    }

    public function test_saas_inquiry_keeps_a_telegram_handle_out_of_the_phone_column(): void
    {
        $this->mock(ZohoLeadService::class, fn (MockInterface $mock) => $mock->shouldReceive('sendLead')->once());

        $this->post(self::INQUIRY, ['contact' => '@acme_founder', 'stage' => '', 'budget' => ''] + self::VALID)
            ->assertSessionHasNoErrors();

        $lead = ContactForm::sole();
        $this->assertNull($lead->email);
        $this->assertNull($lead->phone);
        $this->assertStringContainsString('Contact: @acme_founder', $lead->message);
        $this->assertStringContainsString('Stage: not specified', $lead->message);
    }

    public function test_landing_has_theme_toggle_recaptcha_and_only_consent_gated_tracking(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        $this->assertStringContainsString('data-theme-toggle', $html);
        // Invisible reCAPTCHA v3: a hidden token field plus the notice Google requires when the badge is hidden.
        $this->assertStringContainsString('data-recaptcha-token', $html);
        $this->assertStringNotContainsString('class="g-recaptcha"', $html);
        $this->assertStringContainsString(__('saas.contact.form.recaptcha_notice', [], 'en'), $html);
        $this->assertStringContainsString('https://policies.google.com/terms', $html);
        $this->assertStringContainsString('<option value="">', $html);
        // Trackers ship with the shared cookie banner and are only ever injected after consent.
        $this->assertStringContainsString('id="site-cookie-consent"', $html);
        $this->assertStringContainsString('data-consent-open', $html);
        $this->assertStringContainsString('js/consent.js', $html);
        $this->assertMatchesRegularExpression('/gtag\(.consent., .default.,\s*\{[^}]*analytics_storage.: .denied./s', $html);
        $this->assertStringContainsString("DigiConsent.on('analytics'", $html);
        $this->assertStringContainsString("DigiConsent.on('marketing'", $html);
        $this->assertStringContainsString('clarity.ms/tag/', $html);
        $this->assertStringNotContainsString('<script async src="https://www.googletagmanager.com', $html);
        $this->assertStringNotContainsString('<script src="https://connect.facebook.net', $html);
        // Fonts are self-hosted, so no visitor IP goes to Google just for typography.
        $this->assertStringNotContainsString('fonts.googleapis.com', $html);
        // reCAPTCHA is injected by script only near the form, never as an eager <script src>.
        $this->assertStringNotContainsString('<script src="https://www.google.com/recaptcha', $html);
    }

    public function test_landing_has_conversion_and_trust_elements(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        // Mobile sticky CTA leading to the form.
        $this->assertMatchesRegularExpression('/data-sticky-cta[\s\S]*?href="#contact"/', $html);
        // Reviews sit right after the projects, before pricing.
        $this->assertLessThan(strpos($html, 'id="pricing"'), strpos($html, 'id="reviews"'));
        $this->assertGreaterThan(strpos($html, 'id="proofs"'), strpos($html, 'id="reviews"'));
        // RODO/GDPR notice next to the form, linking the privacy policy.
        $this->assertStringContainsString(__('saas.contact.form.privacy_notice', [], 'en'), $html);
        $this->assertStringContainsString(route('privacy-policy', ['locale' => 'en']), $html);
        // Founder block: a real person with a photo and verifiable profiles, placed before pricing.
        $this->assertStringContainsString('id="founder"', $html);
        $this->assertStringContainsString('landing/yurii-mokryi.jpg', $html);
        $this->assertFileExists(public_path('landing/yurii-mokryi.jpg'));
        $this->assertStringContainsString('https://linkedin.com/in/yurii-mokryi', $html);
        foreach (['https://www.youtube.com/@YuriiMokryi', 'https://www.tiktok.com/@yriimokryi', 'https://www.instagram.com/yurii_mokryi'] as $profile) {
            $this->assertStringContainsString('href="'.$profile.'"', $html);
        }
        $this->assertLessThan(strpos($html, 'id="pricing"'), strpos($html, 'id="founder"'));
    }

    public function test_form_is_the_primary_action(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        // Hero: one single primary CTA leading to the form; no competing secondary CTA.
        $mainStart = strpos($html, '<main');
        $hero = substr($html, $mainStart, strpos($html, 'id="proofs"') - $mainStart);
        $this->assertStringContainsString('data-testid="hero-cta"', $hero);
        $this->assertStringNotContainsString('data-testid="hero-telegram"', $hero);

        // Contact section: the form comes first, the Telegram/e-mail alternatives below it.
        $contact = substr($html, strpos($html, 'id="contact"'));
        $this->assertLessThan(strpos($contact, 'https://t.me/'), strpos($contact, '<form'));

        // Mobile sticky bar: single focused CTA to the form.
        $this->assertMatchesRegularExpression('/data-sticky-cta[\s\S]*?href="#contact"/', $html);
    }

    public function test_every_project_gallery_shot_has_a_caption_and_both_image_sizes(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        // One cover per project; the lightbox pages through the rest from data-gallery-items.
        $this->assertSame(3, preg_match_all('/data-gallery-items=/', $html));
        $this->assertStringContainsString('data-gallery-dialog', $html);
        $this->assertStringContainsString('data-gallery-step', $html);

        foreach (['en', 'uk', 'pl'] as $locale) {
            foreach (['digipulse', 'vetspace', 'netpostpanel'] as $project) {
                $shots = __("saas.proofs.projects.$project.screens", [], $locale);
                $this->assertNotEmpty($shots, "$locale/$project has no screenshots");

                foreach ($shots as $shot) {
                    $this->assertNotSame('', trim($shot['caption']));
                    $this->assertFileExists(public_path("landing/screens/{$shot['file']}.webp"));
                    $this->assertFileExists(public_path("landing/screens/{$shot['file']}-800.webp"));
                }
            }
        }
    }

    public function test_landing_is_a_short_funnel_with_the_price_up_front(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        // Budget is the first question of this audience: the price anchor sits in the hero.
        $mainStart = strpos($html, '<main');
        $hero = substr($html, $mainStart, strpos($html, 'id="proofs"') - $mainStart);
        $this->assertStringContainsString(__('saas.hero.metrics.price', [], 'en'), $hero);

        // Proof → who → how → price → FAQ → form, each block once.
        $order = array_map(fn (string $id): int|false => strpos($html, 'id="'.$id.'"'), ['proofs', 'founder', 'guarantees', 'pricing', 'faq', 'contact']);
        $this->assertNotContains(false, $order);
        $sorted = $order;
        sort($sorted);
        $this->assertSame($sorted, $order);
        $this->assertSame(7, substr_count($html, '<section'));

        // The agency comparison is one line under the prices, not a separate table.
        $this->assertStringNotContainsString('<table', $html);
        $this->assertStringContainsString(__('saas.pricing.comparison_note', [], 'en'), $html);
    }

    public function test_landing_ux_contract(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        // One primary action with one name: header CTA, sticky bar and submit all lead to / are the form.
        $this->assertMatchesRegularExpression('/<a href="#contact" data-testid="header-cta"/', $html);
        $this->assertStringContainsString(__('saas.nav.cta', [], 'en'), $html);
        $this->assertSame(__('saas.nav.cta', [], 'en'), __('saas.contact.form.submit', [], 'en'));
        $this->assertStringContainsString(__('saas.contact.form.response_time', [], 'en'), $html);

        // Keyboard and anchors: skip link to <main id="main">, anchor offset below the fixed header.
        $this->assertStringContainsString('data-testid="skip-link"', $html);
        $this->assertStringContainsString('<main id="main"', $html);
        $this->assertMatchesRegularExpression('/<html[^>]*class="[^"]*scroll-pt-/', $html);

        // Form: autofill hints, 16px text on phones (iOS zooms into anything smaller), sentence-case labels.
        $this->assertStringContainsString('autocomplete="name"', $html);
        $this->assertStringContainsString('autocomplete="email"', $html);
        $contact = substr($html, strpos($html, 'id="contact"'));
        $this->assertSame(5, substr_count(substr($contact, 0, strpos($contact, '</form>')), 'text-base sm:text-sm'));

        // The availability dot is static and prices say they are net.
        $this->assertStringNotContainsString('animate-ping', $html);
        $this->assertSame(2, substr_count($html, __('saas.pricing.net_label', [], 'en').'</span>'));

        // Cards use a zoomed cover of their first shot.
        foreach (['digipulse', 'vetspace', 'netpostpanel'] as $project) {
            $first = __("saas.proofs.projects.$project.screens", [], 'en')[0]['file'];
            $this->assertFileExists(public_path("landing/screens/$first-cover.webp"));
            $this->assertStringContainsString("landing/screens/$first-cover.webp", $html);
        }
    }

    public function test_dark_theme_gets_the_dark_twin_of_a_screenshot_where_one_exists(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();
        $darkShots = 0;

        foreach (['digipulse', 'vetspace', 'netpostpanel'] as $project) {
            $shots = __("saas.proofs.projects.$project.screens", [], 'en');
            foreach ($shots as $index => $shot) {
                if (! file_exists(public_path("landing/screens/{$shot['file']}-dark.webp"))) {
                    continue;
                }
                $darkShots++;
                // Every size the page can ask for exists in the dark variant too.
                $this->assertFileExists(public_path("landing/screens/{$shot['file']}-dark-800.webp"));
                if ($index === 0) {
                    $this->assertFileExists(public_path("landing/screens/{$shot['file']}-dark-cover.webp"));
                    // Two covers, each shown by one theme only.
                    $this->assertStringContainsString("landing/screens/{$shot['file']}-dark-cover.webp", $html);
                    $this->assertMatchesRegularExpression('/class="hidden dark:block[^"]*"/', $html);
                }
                // The lightbox gets the dark file to show under the dark theme.
                $this->assertStringContainsString(str_replace('/', '\/', "landing/screens/{$shot['file']}-dark.webp"), $html);
            }
        }

        $this->assertGreaterThan(0, $darkShots);
        $this->assertStringContainsString("classList.contains('dark') && item.srcDark", $html);
    }

    public function test_landing_exposes_faq_structured_data_for_every_question(): void
    {
        $html = $this->get(self::LANDING)->assertOk()->getContent();

        $this->assertStringContainsString('"@type":"FAQPage"', $html);
        $this->assertSame(
            count(__('saas.faq.items', [], 'en')),
            substr_count($html, '"@type":"Question"')
        );
    }
}
