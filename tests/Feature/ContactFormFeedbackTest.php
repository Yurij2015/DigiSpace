<?php

namespace Tests\Feature;

use App\Services\ZohoLeadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class ContactFormFeedbackTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    private const EN_CONTACT = '/en/contact-us';

    private const UK_CONTACT = '/uk/contact-us';

    private float $recaptchaScore = 0.9;

    private const VALID = [
        'first_name' => 'Yurii',
        'last_name' => 'Mokryi',
        'phone' => '+380 44 123 4567',
        'email' => 'yurii@example.com',
        'message' => 'Hello there, I need a website.',
        'g-recaptcha-response' => 'token',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();

        Http::fake(['www.google.com/recaptcha/*' => fn () => Http::response([
            'success' => true,
            'action' => 'contact_us',
            'score' => $this->recaptchaScore,
        ])]);
    }

    public function test_phone_field_offers_a_self_hosted_country_selector(): void
    {
        $html = $this->get(self::UK_CONTACT)->assertOk()->getContent();

        // The enhancement is opt-in per field, so losing the flag would go unnoticed otherwise.
        $this->assertStringContainsString('data-intl-phone', $html);
        // The locale pre-selects a likely dial code; every country stays selectable.
        $this->assertStringContainsString('data-intl-country="ua"', $html);
        // Vendored under public/, so the form pulls neither the library nor libphonenumber from a
        // third-party CDN - the same reasoning as the rest of the site's assets.
        $this->assertStringContainsString('vendor/intl-tel-input/js/intlTelInput.min.js', $html);
        $this->assertStringContainsString('vendor/intl-tel-input/css/intlTelInput.min.css', $html);
        $this->assertStringContainsString('vendor/intl-tel-input/js/utils.js', $html);
        $this->assertStringContainsString('js/contact-phone.js', $html);
    }

    public function test_phone_field_is_labelled_above_and_reports_errors_without_a_second_label(): void
    {
        // Clean render: the label sits outside the input, because the country selector occupies
        // the start of the field where the theme would otherwise place it.
        $clean = $this->get(self::EN_CONTACT)->assertOk()->getContent();
        $this->assertMatchesRegularExpression('/<label class="form-label-outside"[^>]*for="contact-phone"/', $clean);

        // Rejected render: the message must appear, and as a span - a second <label for> would
        // merge into the input's accessible name alongside the one above it.
        $rejected = $this->followingRedirects()
            ->from(self::EN_CONTACT)
            ->post(self::EN_CONTACT, ['phone' => 'not-a-number'] + self::VALID)
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('id="contact-phone-error"', $rejected);
        $this->assertStringContainsString('aria-describedby="contact-phone-error"', $rejected);
        $this->assertStringNotContainsString('<label class="form-label label-error" for="contact-phone">', $rejected);
        // The label above the field survives the error state, so the input is still named.
        $this->assertMatchesRegularExpression('/<label class="form-label-outside"[^>]*for="contact-phone"/', $rejected);
    }

    public function test_invalid_email_keeps_the_other_values_and_shows_only_the_email_error(): void
    {
        $this->from(self::EN_CONTACT)
            ->post(self::EN_CONTACT, ['email' => 'not-an-email'] + self::VALID)
            ->assertRedirect(self::EN_CONTACT)
            ->assertSessionHasErrors(['email'])
            ->assertSessionDoesntHaveErrors(['first_name', 'last_name', 'phone', 'message']);

        $page = $this->followingRedirects()->from(self::EN_CONTACT)
            ->post(self::EN_CONTACT, ['email' => 'not-an-email'] + self::VALID);

        $page->assertOk()
            ->assertSee('value="Yurii"', false)
            ->assertSee('value="Mokryi"', false)
            ->assertSee('value="+380 44 123 4567"', false)
            ->assertSee('Hello there, I need a website.')
            ->assertSee('value="not-an-email"', false)
            ->assertSee('<label class="form-label label-error" for="contact-email">', false)
            ->assertDontSee('<label class="form-label label-error" for="first-name">', false)
            ->assertDontSee('<label class="form-label label-error" for="last-name">', false)
            ->assertDontSee('<label class="form-label label-error" for="contact-phone">', false)
            ->assertDontSee('<label class="form-label label-error" for="contact-message">', false);

        $this->assertSame(1, substr_count($page->getContent(), 'aria-invalid="true"'), 'only the e-mail input is marked invalid');
    }

    public function test_missing_first_name_error_label_targets_its_input(): void
    {
        $this->followingRedirects()->from(self::EN_CONTACT)
            ->post(self::EN_CONTACT, ['first_name' => ''] + self::VALID)
            ->assertOk()
            ->assertSee('<label class="form-label label-error" for="first-name">', false)
            ->assertDontSee('for="contact-name"', false);
    }

    public function test_inputs_declare_their_purpose(): void
    {
        $this->get(self::EN_CONTACT)
            ->assertOk()
            ->assertSee('type="tel" name="phone"', false)
            ->assertSee('autocomplete="tel"', false)
            ->assertSee('autocomplete="email"', false)
            ->assertSee('autocomplete="given-name"', false)
            ->assertSee('autocomplete="family-name"', false);
    }

    public function test_labels_are_localized(): void
    {
        $this->get('/pl/contact-us')
            ->assertOk()
            ->assertSee('Formularz kontaktowy')
            ->assertSee('for="first-name">Imię', false)
            ->assertSee('Wyślij wiadomość')
            ->assertDontSee('Send Message');
    }

    public function test_valid_submission_stores_the_lead_and_confirms_in_the_visitor_locale(): void
    {
        $this->mock(ZohoLeadService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendLead')->once()->withArgs(fn (array $lead) => $lead['name'] === 'Yurii Mokryi');
        });

        $this->from(self::UK_CONTACT)
            ->post(self::UK_CONTACT, self::VALID)
            ->assertRedirect(self::UK_CONTACT)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Ми отримали ваше повідомлення. Дякуємо, що написали нам!');

        $this->assertDatabaseHas('contact_forms', ['email' => 'yurii@example.com', 'name' => 'Yurii Mokryi', 'source' => 'contact-us']);

        $this->get(self::UK_CONTACT)
            ->assertOk()
            ->assertSee('Ми отримали ваше повідомлення')
            ->assertDontSee('value="Yurii"', false);
    }

    public function test_the_form_uses_invisible_recaptcha_v3_without_a_checkbox_widget(): void
    {
        $html = $this->get(self::EN_CONTACT)->assertOk()->getContent();

        // v3 mints a token into a hidden field; the v2 checkbox widget and its eager api.js are gone.
        $this->assertStringContainsString('data-recaptcha-token', $html);
        $this->assertStringContainsString('data-recaptcha-sitekey', $html);
        $this->assertStringContainsString('js/contact-form.js', $html);
        $this->assertStringNotContainsString('class="g-recaptcha"', $html);
    }

    public function test_ajax_submission_returns_json_instead_of_a_redirect(): void
    {
        $this->mock(ZohoLeadService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendLead')->once();
        });

        $this->postJson(self::EN_CONTACT, self::VALID)
            ->assertOk()
            ->assertJson(['message' => 'We have received your message and would like to thank you for writing to us!']);

        $this->assertDatabaseHas('contact_forms', ['email' => 'yurii@example.com', 'source' => 'contact-us']);
    }

    public function test_ajax_validation_failure_returns_422_with_field_errors(): void
    {
        $this->postJson(self::EN_CONTACT, ['email' => 'not-an-email'] + self::VALID)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email'])
            ->assertJsonMissingValidationErrors(['first_name', 'phone', 'message']);
    }

    public function test_a_low_recaptcha_v3_score_rejects_the_submission(): void
    {
        $this->recaptchaScore = 0.1;

        $this->postJson(self::EN_CONTACT, self::VALID)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['g-recaptcha-response']);

        $this->assertDatabaseMissing('contact_forms', ['email' => 'yurii@example.com']);
    }

    public function test_ajax_throttling_answers_429_json_instead_of_a_redirect(): void
    {
        $this->mock(ZohoLeadService::class, fn (MockInterface $mock) => $mock->shouldReceive('sendLead'));

        for ($i = 0; $i < 10; $i++) {
            $this->postJson(self::EN_CONTACT, self::VALID)->assertOk();
        }

        $this->postJson(self::EN_CONTACT, self::VALID)
            ->assertStatus(429)
            ->assertJsonStructure(['message', 'errors' => ['throttle']]);
    }

    public function test_array_inputs_are_rejected_without_causing_server_errors(): void
    {
        $this->postJson(self::EN_CONTACT, ['first_name' => ['evil' => 'array']] + self::VALID)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['first_name']);
    }

    public function test_overly_long_fields_are_rejected(): void
    {
        $this->postJson(self::EN_CONTACT, ['first_name' => str_repeat('a', 101)] + self::VALID)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['first_name']);

        $this->postJson(self::EN_CONTACT, ['message' => str_repeat('a', 5001)] + self::VALID)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['message']);
    }
}
