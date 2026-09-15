<?php

namespace Tests\Feature\Concerns;

use App\Providers\ContentServiceProvider;
use Database\Seeders\FooterBottomBarContentSeeder;
use Database\Seeders\FooterUsefulLinkSeeder;
use Database\Seeders\HeaderNavBarContentSeeder;
use Database\Seeders\WidgetCategorySeeder;
use Illuminate\Support\Facades\DB;

/**
 * Minimal fixture for rendering public Blade pages: site chrome rows, the widget
 * categories with the fixed IDs the templates and config/constants.php rely on,
 * and the page rows the public controllers look up by slug. Call after
 * RefreshDatabase has migrated.
 */
trait SeedsPublicSite
{
    protected function seedPublicSite(): void
    {
        $this->seed([
            HeaderNavBarContentSeeder::class,
            FooterBottomBarContentSeeder::class,
            FooterUsefulLinkSeeder::class,
        ]);

        // The 2023_06_11 migration inserts the "Images for pages" category with an
        // auto-increment id; move it to PAGES_IMAGES so ids 1–15 match the constants.
        DB::table('widget_categories')
            ->where('name', 'Images for pages')
            ->update(['id' => config('constants.PAGES_IMAGES')]);
        $this->app->make(WidgetCategorySeeder::class)->run(fixedIds: true);

        DB::table('pages')->insert(collect([
            'services' => 'Services',
            'about' => 'About',
            'contact-us' => 'Contact Us',
            'faq' => 'FAQ',
            'support' => 'Support',
            'privacy-policy' => 'Privacy Policy',
        ])->map(fn (string $name, string $slug) => [
            'name' => $name,
            'slug' => $slug,
            'created_at' => now(),
            'updated_at' => now(),
        ])->values()->all());

        $this->rebootSharedContent();
    }

    /**
     * The provider boots before RefreshDatabase fixtures exist, so re-share
     * the layout data once the rows are in place.
     */
    protected function rebootSharedContent(): void
    {
        (new ContentServiceProvider($this->app))->boot();
    }
}
