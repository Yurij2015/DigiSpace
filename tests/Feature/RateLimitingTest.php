<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RateLimitingTest extends TestCase
{
    use RefreshDatabase;

    /** The URLs the site actually posts to: the footer form and the contact page are locale-prefixed. */
    private const string SUBSCRIBE_URL = '/en/subscriber-save';

    private const string CONTACT_URL = '/en/contact-us';

    protected function setUp(): void
    {
        parent::setUp();

        // RecaptchaRule posts to Google on every contact submission with no short-circuit, so the
        // suite would otherwise make live calls in CI. Failing the check also keeps the request
        // short of the controller, and therefore short of the live Zoho CRM.
        Http::fake(['www.google.com/recaptcha/*' => Http::response(['success' => false])]);
        Http::preventStrayRequests();
    }

    public function test_forgot_password_route_is_rate_limited(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        for ($i = 0; $i < 6; $i++) {
            $this->post('/forgot-password', ['email' => $user->email])->assertStatus(302);
        }

        $this->post('/forgot-password', ['email' => $user->email])->assertStatus(429);
    }

    public function test_subscriber_save_route_is_rate_limited(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->post(self::SUBSCRIBE_URL, ['email' => "user{$i}@example.com"])->assertStatus(302);
        }

        // Over the limit the visitor goes back to the form with a message, not to a bare 429 page.
        $this->post(self::SUBSCRIBE_URL, ['email' => 'overlimit@example.com'])
            ->assertStatus(302)
            ->assertSessionHasErrors('email', null, 'subscribe');

        // Refused before the controller, so nothing was written.
        $this->assertDatabaseMissing('subscribers', ['email' => 'overlimit@example.com']);
    }

    public function test_contact_us_route_is_rate_limited(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->post(self::CONTACT_URL, $this->contactPayload())->assertStatus(302);
        }

        // `throttle` is never set by ordinary validation, so this distinguishes the limit from a
        // failed reCAPTCHA, and the flashed old input is what saves the visitor retyping.
        $this->post(self::CONTACT_URL, $this->contactPayload())
            ->assertStatus(302)
            ->assertSessionHasErrors('throttle')
            ->assertSessionHas('_old_input.message', 'Test message')
            ->assertSessionHas('_old_input.email', 'john@example.com');
    }

    public function test_spending_one_endpoint_allowance_leaves_the_others_untouched(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        for ($i = 0; $i < 10; $i++) {
            $this->post(self::SUBSCRIBE_URL, ['email' => "user{$i}@example.com"])->assertStatus(302);
        }
        $this->post(self::SUBSCRIBE_URL, ['email' => 'overlimit@example.com'])
            ->assertSessionHasErrors('email', null, 'subscribe');

        // A bare `throttle:max,decay` keys only on domain and IP, which put every throttled route
        // in one bucket: the newsletter form alone used to 429 password reset on its first request.
        $this->post(self::CONTACT_URL, $this->contactPayload())->assertStatus(302);
        $this->post('/forgot-password', ['email' => $user->email])->assertStatus(302);
    }

    public function test_requesting_reset_links_does_not_block_submitting_the_new_password(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        for ($i = 0; $i < 6; $i++) {
            $this->post('/forgot-password', ['email' => $user->email])->assertStatus(302);
        }
        $this->post('/forgot-password', ['email' => $user->email])->assertStatus(429);

        // Asking for the link and submitting the new password are counted apart, so someone who
        // over-requested can still finish the reset: 302 back with a token error, not a 429.
        $this->post('/reset-password', [
            'token' => 'invalid-token',
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])->assertStatus(302);
    }

    /**
     * @return array<string, string>
     */
    private function contactPayload(): array
    {
        return [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '+380501234567',
            'message' => 'Test message',
            'g-recaptcha-response' => 'fake-token',
        ];
    }
}
