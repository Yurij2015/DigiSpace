<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class SubscribeFormFeedbackTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();

        // The footer only renders the subscribe form for the "Subscribe" footer widget.
        DB::table('widgets')->insert([
            'title' => 'Subscribe',
            'subtitle' => 'Get the latest news',
            'content' => 'Your e-mail',
            'widget_category_id' => config('constants.FOOTER_CATEGORY'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->rebootSharedContent();
    }

    public function test_the_footer_form_posts_without_the_theme_ajax_handler(): void
    {
        $this->get('/uk')
            ->assertOk()
            ->assertSee('action="http://localhost:8100/uk/subscriber-save#footer"', false)
            ->assertDontSee('rd-mailform')
            ->assertSee('Підписатися');
    }

    public function test_invalid_email_shows_the_error_and_keeps_the_value(): void
    {
        $this->followingRedirects()->from('/uk')
            ->post('/uk/subscriber-save', ['email' => 'nope'])
            ->assertOk()
            ->assertSee('id="subscribe-form-footer-form-error" role="alert"', false)
            ->assertSee('value="nope"', false);
    }

    public function test_duplicate_email_is_rejected(): void
    {
        DB::table('subscribers')->insert(['email' => 'dup@example.com', 'created_at' => now(), 'updated_at' => now()]);

        $this->from('/uk')
            ->post('/uk/subscriber-save', ['email' => 'dup@example.com'])
            ->assertRedirect('/uk')
            ->assertSessionHasErrorsIn('subscribe', ['email']);
    }

    public function test_valid_email_is_stored_and_confirmed_in_the_visitor_locale(): void
    {
        $this->from('/pl')
            ->post('/pl/subscriber-save', ['email' => 'new@example.com'])
            ->assertRedirect('/pl')
            ->assertSessionHas('subscribe_success', 'Subskrypcja zakończona pomyślnie!');

        $this->assertDatabaseHas('subscribers', ['email' => 'new@example.com']);

        $this->get('/pl')
            ->assertOk()
            ->assertSee('Subskrypcja zakończona pomyślnie!');
    }

    public function test_contact_form_email_error_does_not_leak_into_the_footer(): void
    {
        $this->followingRedirects()->from('/en/contact-us')
            ->post('/en/contact-us', ['email' => 'bad', 'g-recaptcha-response' => ''])
            ->assertOk()
            ->assertSee('<label class="form-label label-error" for="contact-email">', false)
            ->assertDontSee('id="subscribe-form-footer-form-error"', false);
    }
}
