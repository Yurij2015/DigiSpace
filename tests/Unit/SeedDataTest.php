<?php

namespace Tests\Unit;

use Database\Seeders\Support\SeedData;
use PHPUnit\Framework\TestCase;

/**
 * The seed data files are the single source of the three-language site structure:
 * every translatable field of every row must be complete, identities unique, and the
 * widget categories must keep the IDs the templates rely on.
 */
class SeedDataTest extends TestCase
{
    private const TABLES = [
        'widget_categories', 'widgets', 'menus', 'menu_items', 'footer_useful_links',
        'header_nav_bar_contents', 'footer_bottom_bar_contents',
        'pages', 'categories', 'services', 'products', 'posts',
    ];

    public function test_every_seed_file_loads_and_is_complete_in_all_locales(): void
    {
        foreach (self::TABLES as $table) {
            $data = SeedData::load($table); // throws on a missing locale value

            self::assertSame($table, $data['table']);
            self::assertNotEmpty($data['rows'], "$table has no rows");
        }
    }

    public function test_identities_are_unique_per_table(): void
    {
        foreach (self::TABLES as $table) {
            $data = SeedData::load($table);
            $identity = $data['identity'][0];
            if ($identity === 'singleton') {
                self::assertCount(1, $data['rows'], "$table must have exactly one row");

                continue;
            }
            // Identity may be a base column (slug, id) or a base-language translatable field (name).
            $keys = array_map(fn (array $row) => $identity === 'element_id'
                ? ($row['element_id'] ?: $row['widget_category_id'].'|'.$row['i18n']['en']['title'])
                : ($row[$identity] ?? $row['i18n']['en'][$identity]), $data['rows']);

            self::assertSame(count($keys), count(array_unique($keys)), "$table has duplicate identities");
        }
    }

    public function test_widget_category_ids_match_the_template_constants(): void
    {
        $constants = require dirname(__DIR__, 2).'/config/constants.php';
        $rows = collect(SeedData::load('widget_categories')['rows'])->keyBy('id');

        self::assertSame(range(1, 15), $rows->keys()->sort()->values()->all(), 'categories 1–15 are seeded with fixed IDs');
        self::assertSame('Footer', $rows[$constants['FOOTER_CATEGORY']]['i18n']['en']['name']);
        self::assertSame('Why Choose Us', $rows[$constants['CHOOSE_US_WIDGET_CATEGORY']]['i18n']['en']['name']);
        self::assertSame('Our Clients', $rows[$constants['WIDGET_CATEGORY_PROJECTS']]['i18n']['en']['name']);
    }

    public function test_footer_widgets_carry_their_slot_keys(): void
    {
        $footer = array_filter(SeedData::load('widgets')['rows'], fn (array $row) => $row['widget_category_id'] === 11);
        $slots = array_column($footer, 'element_id');

        foreach (['footer-phone', 'footer-subscribe', 'footer-about', 'footer-latest-news', 'footer-useful-links'] as $slot) {
            self::assertContains($slot, $slots);
        }
    }

    public function test_rows_map_to_base_columns_plus_pruned_translations(): void
    {
        $row = SeedData::toColumns([
            'slug' => 'x',
            'i18n' => ['en' => ['name' => 'Name'], 'uk' => ['name' => 'Назва'], 'pl' => ['name' => '']],
        ]);

        self::assertSame('Name', $row['name']);
        self::assertSame(['uk' => ['name' => 'Назва']], json_decode($row['translations'], true));
        self::assertArrayNotHasKey('i18n', $row);
    }
}
