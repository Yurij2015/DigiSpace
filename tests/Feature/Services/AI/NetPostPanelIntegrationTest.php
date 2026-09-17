<?php

namespace Tests\Feature\Services\AI;

use App\Services\AI\ContentGeneratorService;
use Database\Seeders\GenerationConfigSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NetPostPanelIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (empty(config('services.netpostpanel.key'))) {
            $this->markTestSkipped('NETPOSTPANEL_API_KEY is not configured.');
        }

        $this->seed(GenerationConfigSeeder::class);
    }

    public function test_generate_content_hits_local_netpostpanel(): void
    {
        $service = app(ContentGeneratorService::class);

        $payload = $service->generate(
            entityType: 'post',
            userPrompt: 'Write a short test blog post about Laravel Sail.',
            locale: 'en',
            writingStyle: 'Professional',
            keywords: 'laravel, sail, docker',
        );

        $this->assertArrayHasKey('name', $payload);
        $this->assertNotEmpty($payload['name']);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'generation',
            'entity_type' => 'post',
            'locale' => 'en',
        ]);
    }

    public function test_translate_content_hits_local_netpostpanel(): void
    {
        $service = app(ContentGeneratorService::class);

        $payload = $service->translate(
            entityType: 'post',
            sourceContent: [
                'name' => 'Test post title',
                'content' => 'Test post content',
            ],
            targetLocale: 'uk',
            translationMode: 'adapted',
        );

        $this->assertArrayHasKey('name', $payload);
        $this->assertNotEmpty($payload['name']);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'translation',
            'entity_type' => 'post',
            'locale' => 'uk',
        ]);
    }
}
