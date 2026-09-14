<?php

namespace Tests\Feature;

use App\Providers\ContentServiceProvider;
use Database\Seeders\FooterBottomBarContentSeeder;
use Database\Seeders\FooterUsefulLinkSeeder;
use Database\Seeders\HeaderNavBarContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            HeaderNavBarContentSeeder::class,
            FooterBottomBarContentSeeder::class,
            FooterUsefulLinkSeeder::class,
        ]);

        foreach ([10 => 'Our Clients', 12 => 'Why Choose Us'] as $id => $name) {
            DB::table('widget_categories')->insert([
                'id' => $id,
                'name' => $name,
                'title' => $name,
                'description' => $name,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('pages')->insert([
            ['name' => 'Services', 'slug' => 'services', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'About', 'slug' => 'about', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // The provider boots before RefreshDatabase fixtures are created.
        (new ContentServiceProvider($this->app))->boot();
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
            ->assertSee('<li class="language-switcher">', false)
            ->assertSee('<ul class="rd-navbar-dropdown">', false);
    }

    public function test_locale_switch_persists_for_admin_and_public_requests(): void
    {
        $this->get('/locale/pl')->assertRedirect();

        $this->get('/')
            ->assertOk()
            ->assertSee('<html class="wide wow-animation" lang="pl">', false);
    }
}
