<?php

namespace Tests\Feature;

use App\Http\Controllers\Development\LandingController;
use App\Services\ZohoLeadService;
use App\Support\Locales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\TestCase;

class DevelopmentLandingsTest extends TestCase
{
    use RefreshDatabase;

    private const NEW_LANDINGS = [
        'laravel',
        'symfony',
        'api-integrations',
        'php-support',
        'php-audit',
    ];

    private const VALID = [
        'project_name' => 'Acme Tech',
        'contact' => 'lead@acme.test',
        'stage' => 'spec',
        'budget' => 'sprint',
        'description' => 'Need senior PHP engineering help.',
        'g-recaptcha-response' => 'token',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.recaptcha_v3.site_key' => 'test-site-key', 'services.recaptcha_v3.secret_key' => 'test-secret']);
        Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => true, 'score' => 0.9, 'action' => 'saas_inquiry'])]);
    }

    public function test_all_new_landings_have_the_same_keys_as_saas_in_every_locale(): void
    {
        $keys = fn (string $file): array => collect(Arr::dot(require base_path($file)))->keys()
            ->map(fn (string $key): string => preg_replace('/\.stack\.\d+$/', '.stack', $key))
            ->unique()->sort()->values()->all();

        foreach (config('locales.supported') as $locale) {
            $saas = $keys("lang/{$locale}/saas.php");

            foreach (self::NEW_LANDINGS as $copy) {
                $actual = $keys("lang/{$locale}/{$copy}.php");
                $this->assertSame($saas, $actual, "lang/{$locale}/{$copy}.php differs from saas.php in its keys");
            }
        }
    }

    public function test_all_new_landings_render_cleanly_with_canonical_form_and_og_image(): void
    {
        foreach (self::NEW_LANDINGS as $copy) {
            $routeName = LandingController::LANDINGS[$copy]['route'];

            foreach (config('locales.supported') as $locale) {
                $file = "landing/og-{$copy}-{$locale}.png";
                $this->assertFileExists(public_path($file));
                $this->assertSame([1200, 630], array_slice(getimagesize(public_path($file)), 0, 2), "{$file} must be 1200×630");

                $html = $this->get("/{$locale}/development/{$copy}")
                    ->assertOk()
                    ->assertViewIs('development.landing')
                    ->getContent();

                $this->assertDoesNotMatchRegularExpression('/>\s*(saas|business|laravel|symfony|api-integrations|php-support|php-audit|site)\.[a-z_.]+\s*</', $html);
                $this->assertStringContainsString(e(__("{$copy}.hero.title", [], $locale)), $html);
                $this->assertStringContainsString('rel="canonical" href="'.route($routeName, ['locale' => $locale]).'"', $html);
                $this->assertStringContainsString('action="'.route($routeName.'.inquiry', ['locale' => $locale]).'"', $html);
                $this->assertMatchesRegularExpression('#<meta property="og:image" content="[^"]*/'.preg_quote($file, '#').'\?v=\d+">#', $html);
            }
        }
    }

    public function test_all_new_landings_are_registered_as_localized_routes(): void
    {
        foreach (self::NEW_LANDINGS as $copy) {
            foreach (config('locales.supported') as $locale) {
                $this->assertSame("/{$locale}/development/{$copy}", Locales::localizedPath("/development/{$copy}", $locale));
                $this->assertSame("/{$locale}/development/{$copy}", Locales::localizeUrl("development/{$copy}", $locale));
            }
        }
    }

    public function test_each_new_landing_stores_inquiry_with_its_own_source(): void
    {
        foreach (self::NEW_LANDINGS as $copy) {
            $expectedSource = LandingController::LANDINGS[$copy]['source'];
            $landingUrl = "/uk/development/{$copy}";
            $inquiryUrl = "/uk/development/{$copy}-inquiry";

            $this->mock(ZohoLeadService::class, function (MockInterface $mock) use ($expectedSource) {
                $mock->shouldReceive('sendLead')->once()->withArgs(
                    fn (array $lead) => $lead['source'] === $expectedSource
                );
            });

            $this->from($landingUrl)
                ->post($inquiryUrl, self::VALID)
                ->assertSessionHasNoErrors()
                ->assertRedirect($landingUrl.'#contact')
                ->assertSessionHas('saas_success', true);

            $this->assertDatabaseHas('contact_forms', [
                'name' => 'Acme Tech',
                'email' => 'lead@acme.test',
                'source' => $expectedSource,
            ]);
        }
    }

    public function test_validation_messages_use_each_landings_own_form_labels(): void
    {
        foreach (self::NEW_LANDINGS as $copy) {
            $landingUrl = "/uk/development/{$copy}";
            $inquiryUrl = "/uk/development/{$copy}-inquiry";
            $expectedLabel = __("{$copy}.contact.form.description", [], 'uk');

            $this->from($landingUrl)
                ->post($inquiryUrl, ['description' => ''] + self::VALID)
                ->assertRedirect($landingUrl.'#contact')
                ->assertSessionHasErrors(['description' => "Заповніть поле «{$expectedLabel}»."]);
        }
    }
}
