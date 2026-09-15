<?php

namespace Tests\Feature;

use Database\Seeders\CategorySeeder;
use Database\Seeders\FooterBottomBarContentSeeder;
use Database\Seeders\FooterUsefulLinkSeeder;
use Database\Seeders\HeaderNavBarContentSeeder;
use Database\Seeders\MenuItemSeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\PageWidgetSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductServiceSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WidgetCategorySeeder;
use Database\Seeders\WidgetIconSeeder;
use Database\Seeders\WidgetSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

/**
 * A fresh install seeded from the JSON data (the LocalDevelopmentSeeder sequence) renders a
 * fully translated structure.
 */
class LocalDevelopmentSeederTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    /**
     * Mirrors LocalDevelopmentSeeder step by step (its "fresh ID sequence" guard cannot be
     * satisfied inside the RefreshDatabase transaction): relocate the migration-created image
     * category to PAGES_IMAGES, then the fixed-ID categories and the JSON-backed seeders.
     */
    protected function setUp(): void
    {
        parent::setUp();

        DB::table('widget_categories')->where('name', 'Images for pages')->update(['id' => config('constants.PAGES_IMAGES')]);
        $this->app->make(WidgetCategorySeeder::class)->run(fixedIds: true);
        $this->seed([
            WidgetSeeder::class, WidgetIconSeeder::class, UserSeeder::class, PageSeeder::class, PageWidgetSeeder::class,
            MenuSeeder::class, MenuItemSeeder::class, ProductSeeder::class, ServiceSeeder::class, ProductServiceSeeder::class,
            CategorySeeder::class, PostSeeder::class, HeaderNavBarContentSeeder::class, FooterBottomBarContentSeeder::class,
            FooterUsefulLinkSeeder::class,
        ]);
        $this->rebootSharedContent();
    }

    public function test_widget_categories_keep_the_constant_ids(): void
    {
        self::assertSame('Why Choose Us', DB::table('widget_categories')->where('id', config('constants.CHOOSE_US_WIDGET_CATEGORY'))->value('name'));
        self::assertSame('Footer', DB::table('widget_categories')->where('id', config('constants.FOOTER_CATEGORY'))->value('name'));
        self::assertSame('Images for pages', DB::table('widget_categories')->where('id', config('constants.PAGES_IMAGES'))->value('name'));
    }

    public function test_ukrainian_home_shows_translated_structure(): void
    {
        $this->get('/uk')
            ->assertOk()
            ->assertSee('Чому обирають нас')           // widget category heading
            ->assertSee('Якісне обладнання')           // widget title
            ->assertSee('Про нас</a>', false)          // mega-menu item
            ->assertSee('Останні новини')              // footer widget
            ->assertSee('Корисні посилання')
            ->assertSee('Політика конфіденційності')   // footer bottom bar
            ->assertDontSee('<h2>Why Choose Us</h2>', false); // the English heading (an HTML comment still carries the name)
    }

    public function test_polish_home_shows_translated_structure(): void
    {
        $this->get('/pl')
            ->assertOk()
            ->assertSee('Dlaczego my')
            ->assertSee('Najnowsze wiadomości')
            ->assertSee('Polityka prywatności');
    }

    public function test_english_home_is_unchanged(): void
    {
        $this->get('/en')
            ->assertOk()
            ->assertSee('Why Choose Us')
            ->assertSee('Latest news')
            ->assertSee('Privacy Policy');
    }
}
