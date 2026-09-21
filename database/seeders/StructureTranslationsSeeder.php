<?php

namespace Database\Seeders;

use App\Support\Translations;
use Database\Seeders\Support\SeedData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Adds uk/pl translations from database/seeders/data/*.json to an already populated database
 * (testing, production). Rows are matched by their stable identity; only locales that are
 * missing are filled — translations an editor already made always win — base columns are never
 * touched, and footer widgets get their slot key (element_id) backfilled. Safe to run repeatedly:
 *
 *   php artisan db:seed --class=StructureTranslationsSeeder --force
 */
class StructureTranslationsSeeder extends Seeder
{
    /** @var list<string> */
    public const TABLES = [
        'widget_categories', 'widgets', 'menus', 'menu_items', 'footer_useful_links',
        'header_nav_bar_contents', 'footer_bottom_bar_contents',
        'pages', 'categories', 'services', 'service_categories', 'products', 'posts',
    ];

    /** @var array<string, array{updated: int, unchanged: int, unmatched: int}> */
    public array $summary = [];

    public function run(): void
    {
        foreach (self::TABLES as $table) {
            $this->summary[$table] = $this->seedTable($table);

            // Rows captured from the production database that are absent from the
            // fresh-install data live under data/prod/ — same format, same merge rules.
            $prodData = 'prod/'.$table;
            if (is_file(SeedData::path($prodData))) {
                $extra = $this->seedTable($prodData);
                foreach (['updated', 'unchanged', 'unmatched'] as $key) {
                    $this->summary[$table][$key] += $extra[$key];
                }
            }
        }

        if (! isset($this->command)) {
            return;
        }

        $this->command->table(
            ['table', 'updated', 'unchanged', 'unmatched (in data, not in DB)'],
            collect($this->summary)->map(fn (array $s, string $t) => [$t, $s['updated'], $s['unchanged'], $s['unmatched']])->values()->all(),
        );
    }

    /**
     * @return array{updated: int, unchanged: int, unmatched: int}
     */
    private function seedTable(string $table): array
    {
        $data = SeedData::load($table);
        $dbTable = basename($table);
        $stats = ['updated' => 0, 'unchanged' => 0, 'unmatched' => 0];

        foreach ($data['rows'] as $row) {
            $record = $this->match($dbTable, $data['identity'][0], $row);

            if ($record === null) {
                $stats['unmatched']++;

                continue;
            }

            $seeded = Translations::prune(SeedData::translations($row['i18n']));
            $existing = Translations::prune($record->translations ?? null);
            // Existing (editor-made) values win; the seed only fills what is missing.
            $merged = array_replace_recursive($seeded, $existing);

            $changes = [];
            // Loose comparison: MySQL reorders JSON object keys, which must not count as a change.
            if ($merged != $existing) {
                $changes['translations'] = Translations::encode($merged);
            }
            if ($dbTable === 'widgets' && filled($row['element_id'] ?? null) && blank($record->element_id ?? null)) {
                $changes['element_id'] = $row['element_id'];
            }

            if ($changes === []) {
                $stats['unchanged']++;

                continue;
            }

            DB::table($dbTable)->where('id', $record->id)->update($changes + ['updated_at' => now()]);
            $stats['updated']++;
        }

        return $stats;
    }

    /**
     * Resolve the database row for a seed row by the table's identity rule.
     *
     * @param  array<string, mixed>  $row
     */
    private function match(string $table, string $identity, array $row): ?object
    {
        $query = DB::table($table);

        return match ($identity) {
            'singleton' => $query->orderBy('id')->first(),
            'id' => $query->where('id', $row['id'])->first(),
            'element_id' => $this->matchWidget($row),
            default => $query->where($identity, $row[$identity] ?? $row['i18n']['en'][$identity] ?? null)->first(),
        };
    }

    /**
     * Widgets: by slot key when both sides have one, else by category + base-language title.
     *
     * @param  array<string, mixed>  $row
     */
    private function matchWidget(array $row): ?object
    {
        if (filled($row['element_id'] ?? null)) {
            $bySlot = DB::table('widgets')->where('element_id', $row['element_id'])->first();
            if ($bySlot !== null) {
                return $bySlot;
            }
        }

        return DB::table('widgets')
            ->where('widget_category_id', $row['widget_category_id'])
            ->where('title', $row['i18n']['en']['title'])
            ->orderBy('id')
            ->first();
    }
}
