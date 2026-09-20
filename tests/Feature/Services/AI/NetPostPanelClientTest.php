<?php

namespace Tests\Feature\Services\AI;

use App\Services\AI\NetPostPanelClient;
use App\Services\AI\NetPostPanelRateLimitedException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NetPostPanelClientTest extends TestCase
{
    private const API_URL = 'https://net-post-panel.test';

    private const GENERATED_TITLE = 'Generated Title';

    private NetPostPanelClient $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new NetPostPanelClient;
    }

    public function test_generate_content_sends_correct_request_to_generate_endpoint(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response([
                'request_id' => 'req-uuid-1',
                'status' => 'succeeded',
                'payload' => ['name' => self::GENERATED_TITLE, 'content' => 'Generated content'],
                'rag_sources_used' => 4,
                'rag_sources' => ['https://a.test', 'https://b.test'],
            ], 200),
        ]);

        $payload = ['entity_type' => 'post', 'user_prompt' => 'Test prompt'];
        $result = $this->client->generateContent($payload);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://net-post-panel.test/api/v1/generate'
                && $request->hasHeader('X-API-KEY', 'test-api-key')
                && $request->method() === 'POST';
        });

        $this->assertEquals('req-uuid-1', $result['request_id']);
        $this->assertEquals('succeeded', $result['status']);
        $this->assertEquals(['name' => self::GENERATED_TITLE, 'content' => 'Generated content'], $result['payload']);
        $this->assertEquals(4, $result['rag_sources_used']);
    }

    public function test_translate_content_sends_correct_request_to_translate_endpoint(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/translate' => Http::response([
                'request_id' => 'req-uuid-2',
                'status' => 'succeeded',
                'payload' => ['name' => 'Translated Title', 'content' => 'Translated content'],
            ], 200),
        ]);

        $payload = ['entity_type' => 'post', 'source_content' => ['name' => 'Test']];
        $result = $this->client->translateContent($payload);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://net-post-panel.test/api/v1/translate'
                && $request->hasHeader('X-API-KEY', 'test-api-key')
                && $request->method() === 'POST';
        });

        $this->assertEquals('req-uuid-2', $result['request_id']);
        $this->assertEquals(['name' => 'Translated Title', 'content' => 'Translated content'], $result['payload']);
    }

    public function test_throws_exception_when_api_key_is_missing(): void
    {
        config()->set('services.netpostpanel.key', '');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('NetPostPanel API key is not configured.');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_generate_content_sends_accept_json_header(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response([
                'payload' => ['name' => self::GENERATED_TITLE],
            ], 200),
        ]);

        $this->client->generateContent(['entity_type' => 'post', 'user_prompt' => 'Test']);

        Http::assertSent(function ($request) {
            return $request->hasHeader('Accept', 'application/json')
                && $request->hasHeader('X-API-KEY', 'test-api-key');
        });
    }

    public function test_handles_trailing_slash_in_base_url(): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.test/');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response([
                'payload' => ['name' => self::GENERATED_TITLE],
            ], 200),
        ]);

        $result = $this->client->generateContent(['entity_type' => 'post', 'user_prompt' => 'Test']);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://net-post-panel.test/api/v1/generate';
        });

        $this->assertEquals(['name' => self::GENERATED_TITLE], $result['payload']);
    }

    public function test_throws_exception_when_api_request_fails(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/*' => Http::response(null, 500),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to communicate with NetPostPanel API');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_throws_exception_when_response_missing_payload_envelope(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/*' => Http::response(['data' => 'without payload'], 200),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid response format from NetPostPanel API');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_throws_exception_when_payload_is_not_array(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/*' => Http::response(['payload' => 'string instead of array'], 200),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid response format from NetPostPanel API');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_async_generate_returns_pending_status(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/generate' => Http::response([
                'request_id' => 'req-uuid-async',
                'status' => 'pending',
            ], 202),
        ]);

        $result = $this->client->generateContent([
            'entity_type' => 'post',
            'user_prompt' => 'Test',
            'async' => true,
            'callback_url' => 'https://client.test/hooks/netpostpanel',
        ]);

        $this->assertEquals('req-uuid-async', $result['request_id']);
        $this->assertEquals('pending', $result['status']);
    }

    public function test_get_generation_result_polls_status(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/api/v1/generate/req-uuid-1' => Http::response([
                'request_id' => 'req-uuid-1',
                'status' => 'succeeded',
                'result' => ['name' => 'Done', 'content' => 'Content'],
                'error' => null,
            ], 200),
        ]);

        $result = $this->client->getGenerationResult('req-uuid-1');

        Http::assertSent(function ($request) {
            return $request->url() === 'https://net-post-panel.test/api/v1/generate/req-uuid-1'
                && $request->method() === 'GET';
        });

        $this->assertEquals('succeeded', $result['status']);
        $this->assertEquals(['name' => 'Done', 'content' => 'Content'], $result['result']);
    }

    public function test_throws_rate_limited_exception_on_429(): void
    {
        config()->set('services.netpostpanel.url', self::API_URL);
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.test/*' => Http::response(
                ['error' => 'Rate limited'],
                429,
                ['Retry-After' => '30']
            ),
        ]);

        try {
            $this->client->generateContent(['test' => 'data']);
            $this->fail('Expected NetPostPanelRateLimitedException');
        } catch (NetPostPanelRateLimitedException $e) {
            $this->assertEquals(30, $e->retryAfterSeconds);
            $this->assertStringContainsString('Retry after 30 seconds', $e->getMessage());
        }
    }
}
