<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class AdminRouteAuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedPublicSite();
    }

    public function test_guest_is_redirected_to_login_from_admin_routes(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
        $this->get('/admin/posts')->assertRedirect(route('login'));
        $this->get('/dashboard')->assertRedirect(route('login'));
    }

    public function test_authenticated_non_admin_user_receives_forbidden(): void
    {
        $user = User::factory()->create([
            'email' => 'regular.user@example.test',
            'email_verified_at' => now(),
        ]);

        config()->set('filament.admin_emails', ['superadmin@example.test']);

        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($user)->get('/admin/posts')->assertForbidden();
        $this->actingAs($user)->get('/dashboard')->assertForbidden();
    }

    public function test_authenticated_admin_user_can_access_admin_routes(): void
    {
        $admin = User::factory()->create([
            'email' => 'superadmin@example.test',
            'email_verified_at' => now(),
        ]);

        config()->set('filament.admin_emails', ['superadmin@example.test']);

        $this->actingAs($admin)->get('/admin')->assertOk();
        $this->actingAs($admin)->get('/admin/posts')->assertOk();
    }
}
