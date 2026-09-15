<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostsTableTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    private function makePost(User $author, string $slug, string $status): Post
    {
        $category = Category::firstOrCreate(['slug' => 'news'], ['name' => 'News', 'description' => 'News', 'user_id' => $author->id]);

        return Post::create([
            'name' => ucfirst($slug), 'slug' => $slug, 'content' => '<p>x</p>', 'description' => 'd',
            'status' => $status, 'category_id' => $category->id, 'user_id' => $author->id,
        ]);
    }

    public function test_bulk_publish_sets_selected_drafts_to_published(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $a = $this->makePost($admin, 'draft-a', 'draft');
        $b = $this->makePost($admin, 'draft-b', 'draft');
        $c = $this->makePost($admin, 'draft-c', 'draft');

        Livewire::test(ListPosts::class)
            ->callTableBulkAction('publish', [$a, $b])
            ->assertHasNoTableBulkActionErrors();

        self::assertSame(['published', 'published', 'draft'], [$a->fresh()->status, $b->fresh()->status, $c->fresh()->status]);
    }

    public function test_published_filter_hides_drafts(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $published = $this->makePost($admin, 'live', 'published');
        $draft = $this->makePost($admin, 'wip', 'draft');

        Livewire::test(ListPosts::class)
            ->filterTable('published', true)
            ->assertCanSeeTableRecords([$published])
            ->assertCanNotSeeTableRecords([$draft]);
    }

    public function test_view_on_site_links_to_the_localized_post_url_for_published_posts_only(): void
    {
        $admin = $this->actingAsFilamentAdmin();
        $published = $this->makePost($admin, 'live', 'published');
        $draft = $this->makePost($admin, 'wip', 'draft');
        app()->setLocale('pl');

        Livewire::test(EditPost::class, ['record' => $published->getRouteKey()])
            ->assertActionExists('viewOnSite')
            ->assertActionHasUrl('viewOnSite', 'http://localhost:8100/pl/blog/live')
            ->assertActionShouldOpenUrlInNewTab('viewOnSite')
            ->assertActionEnabled('viewOnSite');

        Livewire::test(EditPost::class, ['record' => $draft->getRouteKey()])
            ->assertActionDisabled('viewOnSite');
    }

    public function test_view_on_site_for_pages_follows_the_menu_item_slug(): void
    {
        $this->actingAsFilamentAdmin();
        $menu = Menu::create(['name' => 'Submenu', 'title' => 'Submenu', 'description' => 'd', 'location' => 'header', 'slug' => 'submenu', 'href' => '#']);
        $item = MenuItem::create(['name' => 'About', 'slug' => 'about-us', 'href' => '/pages/about-us', 'menu_id' => $menu->id]);
        $linked = Page::create(['name' => 'About', 'slug' => 'about', 'meta' => 'm', 'description' => 'd', 'content' => '<p>x</p>', 'menu_item_id' => $item->id]);
        $orphan = Page::create(['name' => 'Orphan', 'slug' => 'orphan', 'meta' => 'm', 'description' => 'd', 'content' => '<p>x</p>']);
        app()->setLocale('uk');

        Livewire::test(EditPage::class, ['record' => $linked->getRouteKey()])
            ->assertActionHasUrl('viewOnSite', 'http://localhost:8100/uk/pages/about-us')
            ->assertActionEnabled('viewOnSite');

        Livewire::test(EditPage::class, ['record' => $orphan->getRouteKey()])
            ->assertActionDisabled('viewOnSite');
    }
}
