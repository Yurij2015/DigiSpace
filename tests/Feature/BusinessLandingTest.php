<?php

namespace Tests\Feature;

use App\Models\ContactForm;
use App\Services\ZohoLeadService;
use App\Support\Locales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * /development/business shares the SaaS landing template; only the copy (lang/{locale}/business.php),
 * the canonical route and the lead source differ.
 */
class BusinessLandingTest extends TestCase
{
    use RefreshDatabase;

    private const LANDING = '/pl/development/business';

    private const INQUIRY = '/pl/development/business-inquiry';

    private const VALID = [
        'project_name' => 'Gabinet Fizjo',
        'contact' => 'kontakt@fizjo.test',
        'stage' => 'idea',
        'budget' => 'sprint',
        'description' => 'Rezerwacje online dla 3 fizjoterapeutów.',
        'g-recaptcha-response' => 'token',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.recaptcha_v3.site_key' => 'test-site-key', 'services.recaptcha_v3.secret_key' => 'test-secret']);
        Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => true, 'score' => 0.9, 'action' => 'saas_inquiry'])]);
    }

    public function test_business_copy_has_the_same_keys_as_the_saas_copy_in_every_locale(): void
    {
        // The template reads the same keys from both files, so a key missing here would render raw.
        // A project's "stack" is a free-length list (the template shows the first three items).
        $keys = fn (string $file): array => collect(Arr::dot(require base_path($file)))->keys()
            ->map(fn (string $key): string => preg_replace('/\.stack\.\d+$/', '.stack', $key))
            ->unique()->sort()->values()->all();

        foreach (config('locales.supported') as $locale) {
            $saas = $keys("lang/{$locale}/saas.php");
            $business = $keys("lang/{$locale}/business.php");

            $this->assertSame($saas, $business, "lang/{$locale}/business.php differs from saas.php in its keys");
        }
    }

    public function test_business_landing_renders_its_own_copy_in_every_locale(): void
    {
        foreach (config('locales.supported') as $locale) {
            $html = $this->get("/{$locale}/development/business")->assertOk()->assertViewIs('development.landing')->getContent();

            $this->assertDoesNotMatchRegularExpression('/>\s*(saas|business|site)\.[a-z_.]+\s*</', $html);
            $this->assertStringContainsString(e(__('business.hero.title', [], $locale)), $html);
            $this->assertStringNotContainsString(e(__('saas.hero.title', [], $locale)), $html);
            // Canonical, hreflang and the form point at this landing, not at /development/saas.
            $this->assertStringContainsString('rel="canonical" href="'.route('development.business', ['locale' => $locale]).'"', $html);
            $this->assertStringContainsString('action="'.route('development.business.inquiry', ['locale' => $locale]).'"', $html);
            $this->assertStringNotContainsString('/development/saas', $html);
        }
    }

    public function test_business_landing_is_a_localized_route(): void
    {
        // Registered in config('locales.route_names'): the locale helpers and the global language
        // switch can prefix and resolve /development/business like any other public page.
        foreach (config('locales.supported') as $locale) {
            $this->assertSame("/{$locale}/development/business", Locales::localizedPath('/development/business', $locale));
            $this->assertSame("/{$locale}/development/business", Locales::localizeUrl('development/business', $locale));
        }
        $this->assertSame('/uk/development/saas', Locales::localizedPath('/development/saas', 'uk'));
    }

    public function test_each_landing_and_locale_has_its_own_social_preview(): void
    {
        foreach (['saas', 'business'] as $copy) {
            foreach (config('locales.supported') as $locale) {
                $file = "landing/og-{$copy}-{$locale}.png";
                $this->assertFileExists(public_path($file));
                $this->assertSame([1200, 630], array_slice(getimagesize(public_path($file)), 0, 2), "{$file} must be 1200×630");

                $html = $this->get("/{$locale}/development/{$copy}")->assertOk()->getContent();
                $this->assertMatchesRegularExpression('#<meta property="og:image" content="[^"]*/'.preg_quote($file, '#').'\?v=\d+">#', $html);
                $this->assertMatchesRegularExpression('#<meta name="twitter:image" content="[^"]*/'.preg_quote($file, '#').'\?v=\d+">#', $html);
            }
        }
    }

    public function test_business_inquiry_is_stored_with_its_own_source(): void
    {
        $this->mock(ZohoLeadService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendLead')->once()->withArgs(
                fn (array $lead) => $lead['source'] === ContactForm::SOURCE_BUSINESS_LANDING
                    && str_contains($lead['message'], 'Rezerwacje online dla 3 fizjoterapeutów.')
            );
        });

        $this->from(self::LANDING)
            ->post(self::INQUIRY, self::VALID)
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::LANDING.'#contact')
            ->assertSessionHas('saas_success', true);

        $this->assertDatabaseHas('contact_forms', [
            'name' => 'Gabinet Fizjo',
            'email' => 'kontakt@fizjo.test',
            'source' => ContactForm::SOURCE_BUSINESS_LANDING,
        ]);
    }

    public function test_a_crm_failure_still_thanks_the_visitor_and_keeps_the_lead(): void
    {
        $this->mock(ZohoLeadService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendLead')->once()->andThrow(new \RuntimeException('invalid_code'));
        });

        $this->from(self::LANDING)
            ->post(self::INQUIRY, self::VALID)
            ->assertRedirect(self::LANDING.'#contact')
            ->assertSessionHas('saas_success', true);

        $this->assertDatabaseHas('contact_forms', ['source' => ContactForm::SOURCE_BUSINESS_LANDING]);
    }

    public function test_business_validation_messages_use_the_business_form_labels(): void
    {
        $this->from(self::LANDING)
            ->post(self::INQUIRY, ['description' => ''] + self::VALID)
            ->assertRedirect(self::LANDING.'#contact')
            ->assertSessionHasErrors(['description' => 'Uzupełnij pole „Co ma robić system?”.']);
    }
}
