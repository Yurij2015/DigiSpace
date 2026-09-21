<?php

use Database\Seeders\Support\SeedData;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Replace complete service records with the reviewed multilingual article copy.
     *
     * The source is versioned with the application so a production deploy applies
     * the same content that was reviewed locally, including titles, descriptions,
     * SEO fields, alt text and all locale translations.
     */
    public function up(): void
    {
        $rows = collect(SeedData::load('services')['rows'])
            ->filter(fn (array $row): bool => filled($row['service_category_id'] ?? null))
            ->keyBy('slug');

        DB::table('services')
            ->whereNotNull('service_category_id')
            ->orderBy('id')
            ->get(['id', 'slug'])
            ->each(function (object $service) use ($rows): void {
                $row = $rows->get($service->slug);
                if (! is_array($row)) {
                    return;
                }

                $columns = SeedData::toColumns($row);
                DB::table('services')->where('id', $service->id)->update([
                    'title' => $columns['title'],
                    'details' => $columns['details'],
                    'description' => $columns['description'],
                    'seo_keywords' => $columns['seo_keywords'],
                    'seo_description' => $columns['seo_description'],
                    'seo_title' => $columns['seo_title'],
                    'image_alt' => $columns['image_alt'],
                    'translations' => $columns['translations'],
                    'updated_at' => now(),
                ]);
            });
    }

    /**
     * Content migrations are intentionally forward-only: the previous copy is
     * editorial data, not a deterministic application state to reconstruct.
     */
    public function down(): void {}
};
