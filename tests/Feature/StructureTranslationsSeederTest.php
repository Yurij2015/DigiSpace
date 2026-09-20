<?php

namespace Tests\Feature;

use App\Support\Translations;
use Database\Seeders\StructureTranslationsSeeder;
use Database\Seeders\Support\SeedData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * The populated-database seeder must be additive and repeatable: it fills missing locales,
 * keeps what editors translated, never touches base columns and reports rows it cannot match.
 */
class StructureTranslationsSeederTest extends TestCase
{
    use RefreshDatabase;

    /** Insert the seed rows *without* translations, as a database from before this change looks. */
    private function populateWithoutTranslations(string ...$tables): void
    {
        // The migration-created image category occupies id 1 on a fresh database.
        DB::table('widget_categories')->where('name', 'Images for pages')->update(['id' => config('constants.PAGES_IMAGES')]);

        foreach ($tables as $table) {
            foreach (SeedData::rows($table) as $row) {
                unset($row['translations']);
                if ($table === 'widgets') {
                    $row['element_id'] = null; // footer rows on old databases carry no slot key
                }
                DB::table($table)->insert($row + ['created_at' => now(), 'updated_at' => now()]);
            }
        }
    }

    private function runSeeder(): StructureTranslationsSeeder
    {
        $seeder = $this->app->make(StructureTranslationsSeeder::class);
        $seeder->run();

        return $seeder;
    }

    /** Rows under data/prod/ exist only on production — on this base-seeded DB they all report unmatched. */
    private function prodRowCount(string $table): int
    {
        $path = SeedData::path('prod/'.$table);

        return is_file($path) ? count(SeedData::rows('prod/'.$table)) : 0;
    }

    public function test_missing_translations_are_filled_and_base_columns_untouched(): void
    {
        $this->populateWithoutTranslations('widget_categories', 'widgets', 'menus', 'menu_items');
        $before = DB::table('widgets')->orderBy('id')->get(['id', 'title', 'subtitle', 'content'])->toArray();

        $seeder = $this->runSeeder();

        self::assertSame(15, $seeder->summary['widget_categories']['updated']);
        self::assertSame(52, $seeder->summary['widgets']['updated']);
        self::assertSame($this->prodRowCount('widgets'), $seeder->summary['widgets']['unmatched']);
        self::assertEquals($before, DB::table('widgets')->orderBy('id')->get(['id', 'title', 'subtitle', 'content'])->toArray(), 'base columns changed');

        $about = json_decode(DB::table('menu_items')->where('slug', 'about')->value('translations'), true);
        self::assertSame('Про нас', $about['uk']['name']);
        self::assertSame('O nas', $about['pl']['name']);
    }

    public function test_editor_made_translations_win_and_only_missing_locales_are_added(): void
    {
        $this->populateWithoutTranslations('widget_categories', 'widgets');
        DB::table('widget_categories')->where('id', 12)->update(['translations' => Translations::encode(['uk' => ['name' => 'Чому ми']])]);

        $this->runSeeder();

        $t = json_decode(DB::table('widget_categories')->where('id', 12)->value('translations'), true);
        self::assertSame('Чому ми', $t['uk']['name'], 'editor value overwritten');
        self::assertSame('Dlaczego my', $t['pl']['name'], 'missing pl not added');
        self::assertArrayHasKey('description', $t['uk'], 'other missing uk fields not added');
    }

    public function test_footer_slot_keys_are_backfilled_by_base_title(): void
    {
        $this->populateWithoutTranslations('widget_categories', 'widgets');
        self::assertNull(DB::table('widgets')->where('title', 'Subscribe')->value('element_id'));

        $this->runSeeder();

        self::assertSame('footer-subscribe', DB::table('widgets')->where('title', 'Subscribe')->value('element_id'));
    }

    public function test_unknown_rows_are_left_alone_and_missing_rows_reported(): void
    {
        $this->populateWithoutTranslations('widget_categories', 'menus', 'menu_items');
        DB::table('menu_items')->insert(['name' => 'Custom', 'slug' => 'custom', 'href' => '/pages/custom', 'menu_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('menu_items')->where('slug', 'page-1')->delete();

        $seeder = $this->runSeeder();

        self::assertNull(DB::table('menu_items')->where('slug', 'custom')->value('translations'));
        self::assertSame(1 + $this->prodRowCount('menu_items'), $seeder->summary['menu_items']['unmatched']);
    }

    public function test_running_twice_changes_nothing_the_second_time(): void
    {
        $this->populateWithoutTranslations('widget_categories', 'widgets', 'menus', 'menu_items', 'footer_useful_links');
        $this->runSeeder();
        $snapshot = DB::table('widgets')->orderBy('id')->pluck('translations', 'id')->map(fn ($j) => json_decode($j, true))->toArray();

        $second = $this->runSeeder();

        foreach (StructureTranslationsSeeder::TABLES as $table) {
            self::assertSame(0, $second->summary[$table]['updated'], "$table updated on the second run");
        }
        self::assertEquals($snapshot, DB::table('widgets')->orderBy('id')->pluck('translations', 'id')->map(fn ($j) => json_decode($j, true))->toArray());
    }
}
