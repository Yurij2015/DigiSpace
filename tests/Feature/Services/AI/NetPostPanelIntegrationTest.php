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

        $response = $service->generate(
            entityType: 'post',
            userPrompt: 'Write a short test blog post about Laravel Sail.',
            locale: 'en',
            writingStyle: 'Professional',
            keywords: 'laravel, sail, docker',
        );

        $this->assertEquals('succeeded', $response['status']);
        $this->assertNotEmpty($response['request_id']);
        $this->assertArrayHasKey('name', $response['payload']);
        $this->assertNotEmpty($response['payload']['name']);
        $this->assertIsArray($response['rag_sources']);
        $this->assertGreaterThanOrEqual(0, $response['rag_sources_used']);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'generation',
            'entity_type' => 'post',
            'locale' => 'en',
            'request_id' => $response['request_id'],
            'status' => 'succeeded',
        ]);
    }

    public function test_generate_fast_mode_returns_request_id(): void
    {
        $service = app(ContentGeneratorService::class);

        $response = $service->generate(
            entityType: 'post',
            userPrompt: 'Return ONLY JSON with a name field.',
            locale: 'en',
            rag: false,
        );

        $this->assertEquals('succeeded', $response['status']);
        $this->assertNotEmpty($response['request_id']);
        $this->assertEquals(0, $response['rag_sources_used']);
        $this->assertEquals([], $response['rag_sources']);
    }

    public function test_generate_with_provider_and_model(): void
    {
        $service = app(ContentGeneratorService::class);

        $response = $service->generate(
            entityType: 'post',
            userPrompt: 'Return ONLY JSON {"name":"x"}.',
            locale: 'en',
            provider: 'gemini',
            model: 'gemini-3.5-flash-lite',
            rag: false,
        );

        $this->assertEquals('succeeded', $response['status']);
        $this->assertNotEmpty($response['request_id']);
        $this->assertArrayHasKey('name', $response['payload']);
    }

    public function test_generate_async_returns_pending(): void
    {
        $service = app(ContentGeneratorService::class);

        $response = $service->generate(
            entityType: 'post',
            userPrompt: 'Write about microservices.',
            locale: 'en',
            async: true,
            callbackUrl: 'https://client.test/hooks/netpostpanel',
        );

        $this->assertEquals('pending', $response['status']);
        $this->assertNotEmpty($response['request_id']);

        $this->assertDatabaseHas('generation_attempts', [
            'request_id' => $response['request_id'],
            'status' => 'pending',
        ]);
    }

    public function test_translate_content_hits_local_netpostpanel(): void
    {
        $service = app(ContentGeneratorService::class);

        $response = $service->translate(
            entityType: 'post',
            sourceContent: [
                'name' => 'Test post title',
                'content' => 'Test post content',
            ],
            targetLocale: 'uk',
            translationMode: 'adapted',
        );

        $this->assertEquals('succeeded', $response['status']);
        $this->assertNotEmpty($response['request_id']);
        $this->assertArrayHasKey('name', $response['payload']);
        $this->assertNotEmpty($response['payload']['name']);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'translation',
            'entity_type' => 'post',
            'locale' => 'uk',
            'request_id' => $response['request_id'],
            'status' => 'succeeded',
        ]);
    }

    public function test_translate_literal_mode(): void
    {
        $service = app(ContentGeneratorService::class);

        $response = $service->translate(
            entityType: 'post',
            sourceContent: ['name' => 'Hello', 'content' => 'World'],
            targetLocale: 'uk',
            translationMode: 'literal',
        );

        $this->assertEquals('succeeded', $response['status']);
        $this->assertArrayHasKey('name', $response['payload']);
    }
}
