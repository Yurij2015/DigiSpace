<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RateLimitingTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_route_is_rate_limited(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        for ($i = 0; $i < 6; $i++) {
            $response = $this->post('/forgot-password', ['email' => $user->email]);
            $this->assertNotEquals(429, $response->getStatusCode());
        }

        $response = $this->post('/forgot-password', ['email' => $user->email]);
        $response->assertStatus(429);
    }

    public function test_subscriber_save_route_is_rate_limited(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $response = $this->post('/subscriber-save', ['email' => "user{$i}@example.com"]);
            $this->assertNotEquals(429, $response->getStatusCode());
        }

        $response = $this->post('/subscriber-save', ['email' => 'overlimit@example.com']);
        $response->assertStatus(429);
    }

    public function test_contact_us_route_is_rate_limited(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $response = $this->post('/en/contact-us', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '+380501234567',
                'message' => 'Test message',
                'g-recaptcha-response' => 'fake-token',
            ]);
            $this->assertNotEquals(429, $response->getStatusCode());
        }

        $response = $this->post('/en/contact-us', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '+380501234567',
            'message' => 'Test message',
            'g-recaptcha-response' => 'fake-token',
        ]);
        $response->assertStatus(429);
    }
}
