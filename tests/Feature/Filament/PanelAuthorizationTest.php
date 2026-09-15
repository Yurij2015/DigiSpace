<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Panel admins manage all content; authorship only matters in the legacy Inertia admin.
 */
class PanelAuthorizationTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    public function test_a_panel_admin_can_edit_a_post_written_by_someone_else(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $author = User::factory()->create();
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $author->id]);
        $post = Post::create([
            'name' => 'Theirs', 'slug' => 'theirs', 'content' => '<p>x</p>', 'description' => 'd',
            'status' => 'draft', 'category_id' => $category->id, 'user_id' => $author->id,
        ]);

        self::assertTrue($admin->can('update', $post));
        self::assertTrue($admin->can('delete', $post));
        self::assertTrue($admin->can('update', $category));

        Livewire::test(ListPosts::class)->assertTableActionVisible('edit', $post);

        Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
            ->fillForm(['name' => 'Edited by admin'])
            ->call('save')
            ->assertHasNoFormErrors();

        self::assertSame('Edited by admin', $post->fresh()->getRawOriginal('name'));
    }

    public function test_the_legacy_admin_keeps_author_only_rules(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $author = User::factory()->create();
        $category = Category::create(['name' => 'News', 'slug' => 'news', 'description' => 'News', 'user_id' => $author->id]);
        $post = Post::create([
            'name' => 'Theirs', 'slug' => 'theirs', 'content' => '<p>x</p>', 'description' => 'd',
            'status' => 'draft', 'category_id' => $category->id, 'user_id' => $author->id,
        ]);

        self::assertFalse($admin->can('postUpdate', $post));
        self::assertTrue($author->can('postUpdate', $post));
    }
}
