<?php

use App\Models\GenerationConfig;
use Database\Seeders\GenerationConfigSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * The generation configs are reference data the AI actions depend on
     * (`ContentGeneratorService` resolves them with `firstOrFail()`), so every
     * environment needs them. Deploys only run migrations, never seeders, hence
     * this data migration. It delegates to the seeder to keep one source of
     * truth and is idempotent through `updateOrCreate`.
     */
    public function up(): void
    {
        if (! class_exists(GenerationConfigSeeder::class)) {
            return;
        }

        (new GenerationConfigSeeder)->run();
    }

    public function down(): void
    {
        GenerationConfig::whereIn('entity_type', ['post', 'page'])->delete();
    }
};
