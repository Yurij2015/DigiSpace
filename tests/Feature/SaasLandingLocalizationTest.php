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

        Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => true])]);
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
        $this->withoutVite();
        $locales = config('locales.supported');

        foreach ($locales as $locale) {
            $response = $this->get(route('development.saas', ['locale' => $locale]));
            $response->assertOk();
            $response->assertViewIs('development.saas');

            $html = $response->getContent();

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

    public function test_landing_has_theme_toggle_and_recaptcha_but_no_ungated_tracking(): void
    {
        $this->withoutVite();

        $html = $this->get(self::LANDING)->assertOk()->getContent();

        $this->assertStringContainsString('data-theme-toggle', $html);
        $this->assertStringContainsString('class="g-recaptcha"', $html);
        $this->assertStringContainsString('<option value="">', $html);
        // No cookie banner on this layout, so nothing that needs consent may load.
        $this->assertStringNotContainsString('fbevents.js', $html);
        $this->assertStringNotContainsString('googletagmanager', $html);
    }
}
