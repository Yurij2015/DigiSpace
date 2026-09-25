<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

/**
 * The legacy Inertia admin edits base-language columns only, so its requests must be
 * served in the default locale regardless of the browser language or session choice.
 */
class LegacyAdminLocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_legacy_post_form_receives_base_language_values(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        config()->set('filament.admin_emails', array_merge(config('filament.admin_emails', []), [$user->email]));
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $user->id]);
        $post = Post::create([
            'name' => 'English title', 'slug' => 'english-title', 'content' => '<p>English</p>', 'description' => 'd',
            'status' => 'published', 'category_id' => $category->id, 'user_id' => $user->id,
            'translations' => ['uk' => ['name' => 'Українська назва', 'content' => '<p>Українська</p>']],
        ]);

        $this->actingAs($user)
            ->withSession(['locale' => 'uk'])
            ->withHeaders(['Accept-Language' => 'uk-UA,uk;q=0.9'])
            ->get(route('admin.post-update-form', $post))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Admin/Posts/Update')
                ->where('post.name', 'English title')
                ->where('post.content', '<p>English</p>')
                ->where('locale', 'en'));
    }
}
