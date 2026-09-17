<?php

namespace Tests\Feature;

use App\Models\GenerationConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerationConfigSeedingTest extends TestCase
{
    use RefreshDatabase;

    public function test_migrations_seed_the_generation_configs(): void
    {
        foreach (['post', 'page'] as $entityType) {
            $config = GenerationConfig::where('entity_type', $entityType)->first();

            $this->assertNotNull($config, "Missing generation config for [{$entityType}].");
            $this->assertNotEmpty($config->fields);
            $this->assertNotEmpty($config->system_prompt);
        }
    }

    public function test_the_data_migration_is_idempotent(): void
    {
        $before = GenerationConfig::count();

        $this->artisan('migrate:refresh', ['--path' => 'database/migrations/2026_09_17_170000_seed_generation_configs.php'])
            ->assertSuccessful();

        $this->assertSame($before, GenerationConfig::count());
    }
}
