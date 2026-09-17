<?php

namespace Tests\Feature\Services\AI;

use App\Services\AI\NetPostPanelClient;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NetPostPanelClientTest extends TestCase
{
    private NetPostPanelClient $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new NetPostPanelClient;
    }

    public function test_generate_content_sends_correct_request_to_generate_endpoint(): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.digispace.pro');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.digispace.pro/api/v1/generate' => Http::response([
                'payload' => ['name' => 'Generated Title', 'content' => 'Generated content'],
            ], 200),
        ]);

        $payload = ['entity_type' => 'post', 'user_prompt' => 'Test prompt'];
        $result = $this->client->generateContent($payload);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://net-post-panel.digispace.pro/api/v1/generate'
                && $request->hasHeader('X-API-KEY', 'test-api-key')
                && $request->method() === 'POST';
        });

        $this->assertEquals(['name' => 'Generated Title', 'content' => 'Generated content'], $result);
    }

    public function test_translate_content_sends_correct_request_to_translate_endpoint(): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.digispace.pro');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.digispace.pro/api/v1/translate' => Http::response([
                'payload' => ['name' => 'Translated Title', 'content' => 'Translated content'],
            ], 200),
        ]);

        $payload = ['entity_type' => 'post', 'source_content' => ['name' => 'Test']];
        $result = $this->client->translateContent($payload);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://net-post-panel.digispace.pro/api/v1/translate'
                && $request->hasHeader('X-API-KEY', 'test-api-key')
                && $request->method() === 'POST';
        });

        $this->assertEquals(['name' => 'Translated Title', 'content' => 'Translated content'], $result);
    }

    public function test_throws_exception_when_api_key_is_missing(): void
    {
        config()->set('services.netpostpanel.key', '');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('NetPostPanel API key is not configured.');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_throws_exception_when_api_request_fails(): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.digispace.pro');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.digispace.pro/*' => Http::response(null, 500),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to communicate with NetPostPanel API');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_throws_exception_when_response_missing_payload_envelope(): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.digispace.pro');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.digispace.pro/*' => Http::response(['data' => 'without payload'], 200),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid response format from NetPostPanel API');

        $this->client->generateContent(['test' => 'data']);
    }

    public function test_throws_exception_when_payload_is_not_array(): void
    {
        config()->set('services.netpostpanel.url', 'https://net-post-panel.digispace.pro');
        config()->set('services.netpostpanel.key', 'test-api-key');

        Http::fake([
            'net-post-panel.digispace.pro/*' => Http::response(['payload' => 'string instead of array'], 200),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid response format from NetPostPanel API');

        $this->client->generateContent(['test' => 'data']);
    }

}
