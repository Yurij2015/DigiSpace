<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_localized_public_routes_expose_language_and_alternates(): void
    {
        $response = $this->get('/uk');

        $response
            ->assertOk()
            ->assertSee('<html class="wide wow-animation" lang="uk">', false)
            ->assertSee('hreflang="en"', false)
            ->assertSee('href="http://localhost:8100/en"', false)
            ->assertSee('<div class="site-language-control">', false)
            ->assertSee('aria-label="Мова"', false)
            ->assertSee('value="http://localhost:8100/en"', false)
            ->assertSee('value="http://localhost:8100/pl"', false);
    }

    public function test_locale_switch_persists_for_admin_and_public_requests(): void
    {
        $this->get('/locale/pl')->assertRedirect();

        $this->get('/')
            ->assertOk()
            ->assertSee('<html class="wide wow-animation" lang="pl">', false);
    }
}
