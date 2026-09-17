<?php

namespace Tests\Feature\Services\AI;

use App\Models\Category;
use App\Models\GenerationAttempt;
use App\Models\GenerationConfig;
use App\Models\Post;
use App\Models\User;
use App\Services\AI\ContentGeneratorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ContentGeneratorServiceTest extends TestCase
{
    use RefreshDatabase;

    private ContentGeneratorService $service;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.netpostpanel.url', 'https://net-post-panel.test');
        config()->set('services.netpostpanel.key', 'test-api-key');

        // Seed default generation configs
        GenerationConfig::create([
            'entity_type' => 'post',
            'entity_name' => 'Blog Post',
            'entity_description' => 'Technical blog posts and articles',
            'fields' => ['name', 'content'],
            'seo_fields' => ['description', 'keywords'],
            'default_prompt' => '{prompt}',
            'system_prompt' => 'You are an expert copywriter.',
        ]);

        $this->service = app(ContentGeneratorService::class);
    }

    private function fakeGenerateResponse(array $response): void
    {
        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response($response, 200),
        ]);
    }

    private function fakeTranslateResponse(array $response): void
    {
        Http::fake([
            'net-post-panel.test/api/v1/translate' => Http::response($response, 200),
        ]);
    }

    private function fakeSuccessfulGenerate(): void
    {
        $this->fakeGenerateResponse([
            'request_id' => 'req-uuid-gen',
            'status' => 'succeeded',
            'payload' => [
                'name' => 'Mock Generated Title: AI & Future of Cloud Computing',
                'content' => '<p>Mock Generated Content</p>',
                'description' => 'A comprehensive overview of cloud computing architectures.',
                'keywords' => 'cloud, ai',
            ],
            'rag_sources_used' => 3,
            'rag_sources' => ['https://a.test', 'https://b.test', 'https://c.test'],
        ]);
    }

    private function fakeSuccessfulTranslate(): void
    {
        $this->fakeTranslateResponse([
            'request_id' => 'req-uuid-tr',
            'status' => 'succeeded',
            'payload' => [
                'name' => 'Перекладений заголовок',
                'content' => '<p>Перекладений контент</p>',
                'description' => 'Опис українською',
                'keywords' => 'laravel, php',
            ],
        ]);
    }

    public function test_generate_throws_when_generation_config_is_missing(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->service->generate(
            entityType: 'unknown-entity',
            userPrompt: 'Test prompt',
        );
    }

    public function test_generate_sends_entity_configuration_to_api(): void
    {
        $this->fakeSuccessfulGenerate();
        $user = User::factory()->create();

        $this->service->generate(
            entityType: 'post',
            userPrompt: 'Write an article on Docker containerization',
            locale: 'en',
            writingStyle: 'Professional',
            keywords: 'docker, containers',
            userId: $user->id,
        );

        Http::assertSent(function ($request) {
            $payload = $request->data();

            return $request->url() === 'https://net-post-panel.test/api/v1/generate'
                && $payload['entity_type'] === 'post'
                && $payload['entity_description'] === 'Technical blog posts and articles'
                && $payload['fields'] === ['name', 'content']
                && $payload['seo_fields'] === ['description', 'keywords']
                && $payload['system_prompt'] === 'You are an expert copywriter.'
                && $payload['user_prompt'] === 'Write an article on Docker containerization'
                && $payload['locale'] === 'en'
                && $payload['writing_style'] === 'Professional'
                && $payload['keywords'] === 'docker, containers';
        });
    }

    public function test_translate_sends_translation_payload_to_api(): void
    {
        $this->fakeSuccessfulTranslate();
        $user = User::factory()->create();

        $this->service->translate(
            entityType: 'post',
            sourceContent: ['name' => 'Test title', 'content' => 'Test content'],
            targetLocale: 'uk',
            translationMode: 'adapted',
            userId: $user->id,
        );

        Http::assertSent(function ($request) {
            $payload = $request->data();

            return $request->url() === 'https://net-post-panel.test/api/v1/translate'
                && $payload['entity_type'] === 'post'
                && $payload['source_content'] === ['name' => 'Test title', 'content' => 'Test content']
                && $payload['target_locale'] === 'uk'
                && $payload['translation_mode'] === 'adapted';
        });
    }

    public function test_generate_logs_generation_attempt_for_new_unpersisted_post(): void
    {
        $this->fakeSuccessfulGenerate();
        $user = User::factory()->create();

        $response = $this->service->generate(
            entityType: 'post',
            userPrompt: 'Write an article on Docker containerization',
            locale: 'en',
            writingStyle: 'Professional',
            keywords: 'docker, containers',
            record: null,
            userId: $user->id,
        );

        $this->assertIsArray($response);
        $this->assertEquals('req-uuid-gen', $response['request_id']);
        $this->assertEquals('succeeded', $response['status']);
        $this->assertArrayHasKey('name', $response['payload']);
        $this->assertArrayHasKey('content', $response['payload']);

        $this->assertDatabaseHas('generation_attempts', [
            'request_id' => 'req-uuid-gen',
            'status' => 'succeeded',
            'type' => 'generation',
            'entity_type' => 'post',
            'generatable_type' => null,
            'generatable_id' => null,
            'attempt_number' => 1,
            'locale' => 'en',
            'user_prompt' => 'Write an article on Docker containerization',
            'created_by' => $user->id,
        ]);
    }

    public function test_generate_async_stores_request_id_and_pending_status(): void
    {
        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response([
                'request_id' => 'req-async-uuid',
                'status' => 'pending',
            ], 202),
        ]);

        $user = User::factory()->create();

        $response = $this->service->generate(
            entityType: 'post',
            userPrompt: 'Write an article',
            async: true,
            callbackUrl: 'https://client.test/hooks/netpostpanel',
            userId: $user->id,
        );

        $this->assertEquals('req-async-uuid', $response['request_id']);
        $this->assertEquals('pending', $response['status']);

        $this->assertDatabaseHas('generation_attempts', [
            'request_id' => 'req-async-uuid',
            'status' => 'pending',
            'type' => 'generation',
        ]);

        $attempt = GenerationAttempt::where('request_id', 'req-async-uuid')->first();
        $this->assertEquals([], $attempt->generated_payload);
    }

    public function test_generate_stores_rag_sources(): void
    {
        $this->fakeSuccessfulGenerate();
        $user = User::factory()->create();

        $this->service->generate(
            entityType: 'post',
            userPrompt: 'Test',
            userId: $user->id,
        );

        $attempt = GenerationAttempt::where('type', 'generation')->first();
        $this->assertNotNull($attempt);
        $this->assertEquals(
            ['https://a.test', 'https://b.test', 'https://c.test'],
            $attempt->rag_sources
        );
    }

    public function test_generate_sends_rag_parameters_to_api(): void
    {
        $this->fakeSuccessfulGenerate();
        $user = User::factory()->create();

        $this->service->generate(
            entityType: 'post',
            userPrompt: 'Test',
            provider: 'gemini',
            model: 'gemini-3.5-flash-lite',
            rag: true,
            searchResults: 8,
            sources: 4,
            minUsefulnessScore: 7,
            userId: $user->id,
        );

        Http::assertSent(function ($request) {
            $payload = $request->data();

            return $payload['provider'] === 'gemini'
                && $payload['model'] === 'gemini-3.5-flash-lite'
                && $payload['rag'] === true
                && $payload['search_results'] === 8
                && $payload['sources'] === 4
                && $payload['min_usefulness_score'] === 7;
        });
    }

    public function test_generate_increments_attempt_number_for_existing_post(): void
    {
        $this->fakeSuccessfulGenerate();
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'description' => 'Tech news',
            'user_id' => $user->id,
        ]);

        $post = Post::create([
            'name' => 'Existing Post',
            'slug' => 'existing-post',
            'content' => '<p>Existing body</p>',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        // First generation
        $this->service->generate(
            entityType: 'post',
            userPrompt: 'First revision',
            locale: 'en',
            record: $post,
            userId: $user->id,
        );

        // Second generation
        $this->service->generate(
            entityType: 'post',
            userPrompt: 'Second revision',
            locale: 'en',
            record: $post,
            userId: $user->id,
        );

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'generation',
            'generatable_type' => Post::class,
            'generatable_id' => $post->id,
            'attempt_number' => 1,
            'user_prompt' => 'First revision',
        ]);

        $this->assertDatabaseHas('generation_attempts', [
            'type' => 'generation',
            'generatable_type' => Post::class,
            'generatable_id' => $post->id,
            'attempt_number' => 2,
            'user_prompt' => 'Second revision',
        ]);
    }

    public function test_translate_logs_translation_attempt_with_mode_and_source_content(): void
    {
        $this->fakeSuccessfulTranslate();
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'description' => 'Tech news',
            'user_id' => $user->id,
        ]);

        $post = Post::create([
            'name' => 'Mastering Laravel',
            'slug' => 'mastering-laravel',
            'content' => '<p>Laravel is a web application framework.</p>',
            'description' => 'Master Laravel framework',
            'keywords' => 'laravel, php',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $sourceContent = [
            'name' => $post->name,
            'content' => $post->content,
            'description' => $post->description,
            'keywords' => $post->keywords,
        ];

        $response = $this->service->translate(
            entityType: 'post',
            sourceContent: $sourceContent,
            targetLocale: 'uk',
            translationMode: 'adapted',
            record: $post,
            userId: $user->id,
        );

        $this->assertIsArray($response);
        $this->assertEquals('req-uuid-tr', $response['request_id']);
        $this->assertEquals('succeeded', $response['status']);

        $attempt = GenerationAttempt::where('type', 'translation')->first();
        $this->assertNotNull($attempt);
        $this->assertSame('req-uuid-tr', $attempt->request_id);
        $this->assertSame('succeeded', $attempt->status);
        $this->assertSame('post', $attempt->entity_type);
        $this->assertSame(Post::class, $attempt->generatable_type);
        $this->assertSame($post->id, $attempt->generatable_id);
        $this->assertSame('uk', $attempt->locale);
        $this->assertSame('adapted', $attempt->translation_mode);
        $this->assertEquals($sourceContent, $attempt->source_content);
        $this->assertIsArray($attempt->generated_payload);
    }
}
