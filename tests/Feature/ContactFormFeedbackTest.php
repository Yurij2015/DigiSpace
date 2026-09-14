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

        Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => true])]);
    }

    public function test_invalid_email_keeps_the_other_values_and_shows_only_the_email_error(): void
    {
        $response = $this->from('/en/contact-us')
            ->post('/en/contact-us', ['email' => 'not-an-email'] + self::VALID)
            ->assertRedirect('/en/contact-us')
            ->assertSessionHasErrors(['email'])
            ->assertSessionDoesntHaveErrors(['first_name', 'last_name', 'phone', 'message']);

        $page = $this->followingRedirects()->from('/en/contact-us')
            ->post('/en/contact-us', ['email' => 'not-an-email'] + self::VALID);

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
        $this->followingRedirects()->from('/en/contact-us')
            ->post('/en/contact-us', ['first_name' => ''] + self::VALID)
            ->assertOk()
            ->assertSee('<label class="form-label label-error" for="first-name">', false)
            ->assertDontSee('for="contact-name"', false);
    }

    public function test_inputs_declare_their_purpose(): void
    {
        $this->get('/en/contact-us')
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

        $this->from('/uk/contact-us')
            ->post('/uk/contact-us', self::VALID)
            ->assertRedirect('/uk/contact-us')
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Ми отримали ваше повідомлення. Дякуємо, що написали нам!');

        $this->assertDatabaseHas('contact_forms', ['email' => 'yurii@example.com', 'name' => 'Yurii Mokryi']);

        $this->get('/uk/contact-us')
            ->assertOk()
            ->assertSee('Ми отримали ваше повідомлення')
            ->assertDontSee('value="Yurii"', false);
    }
}
