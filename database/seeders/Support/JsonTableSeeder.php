<?php

namespace Database\Seeders\Support;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Inserts the rows of database/seeders/data/{table}.json (three languages, see SeedData).
 * Rows are inserted with the IDs recorded in the data file: the pivot seeders (page_widget,
 * product_service, widget_icons) and config/constants.php reference them, so seeding is
 * deterministic even when the table's auto-increment counter is not fresh. These seeders
 * are for empty tables only (fresh installs), as documented in docs/local-setup.md.
 */
abstract class JsonTableSeeder extends Seeder
{
    protected string $table;

    /**
     * @param  bool  $fixedIds  kept for the historical WidgetCategorySeeder signature; IDs are always applied
     */
    public function run(bool $fixedIds = true): void
    {
        $now = now();
        $rows = [];

        foreach (SeedData::rows($this->table) as $row) {
            $rows[] = $row + ['created_at' => $now, 'updated_at' => $now];
        }

        foreach (array_chunk($rows, 50) as $chunk) {
            DB::table($this->table)->insert($chunk);
        }
    }
}
