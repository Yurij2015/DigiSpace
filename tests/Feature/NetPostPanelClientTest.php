<?php

namespace Tests\Feature;

use App\Services\AI\NetPostPanelClient;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NetPostPanelClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.netpostpanel.url' => 'https://net-post-panel.digispace.pro',
            'services.netpostpanel.key' => 'test-key',
            'services.netpostpanel.api_host' => null,
        ]);
    }

    public function test_it_returns_the_translated_payload(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            '*/api/v1/translate' => Http::response([
                'request_id' => 'uuid-1',
                'status' => 'succeeded',
                'payload' => ['name' => 'Привіт'],
            ]),
        ]);

        $response = (new NetPostPanelClient)->translateContent([
            'source_content' => ['name' => 'Hello'],
            'target_locale' => 'uk',
            'translation_mode' => 'literal',
        ]);

        $this->assertSame('Привіт', $response['payload']['name']);
        $this->assertSame('uuid-1', $response['request_id']);
    }

    public function test_it_targets_the_configured_base_url(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            '*/api/v1/translate' => Http::response([
                'status' => 'succeeded',
                'payload' => ['name' => 'Cześć'],
            ]),
        ]);

        $response = (new NetPostPanelClient)->translateContent([
            'source_content' => ['name' => 'Hello'],
            'target_locale' => 'pl',
            'translation_mode' => 'adapted',
        ]);

        $this->assertSame('Cześć', $response['payload']['name']);

        Http::assertSent(fn ($request) => $request->url() === 'https://net-post-panel.digispace.pro/api/v1/translate');
    }

    public function test_it_sends_the_host_header_when_calling_an_internal_backend(): void
    {
        config([
            'services.netpostpanel.url' => 'http://127.0.0.1:8080',
            'services.netpostpanel.api_host' => 'net-post-panel.digispace.pro',
        ]);

        Http::preventStrayRequests();
        Http::fake([
            '127.0.0.1:8080/api/v1/translate' => Http::response([
                'status' => 'succeeded',
                'payload' => ['name' => 'Привіт'],
            ]),
        ]);

        (new NetPostPanelClient)->translateContent([
            'source_content' => ['name' => 'Hello'],
            'target_locale' => 'uk',
            'translation_mode' => 'literal',
        ]);

        Http::assertSent(fn ($request) => $request->header('Host') === ['net-post-panel.digispace.pro']);
    }

    public function test_it_does_not_override_the_host_header_when_not_configured(): void
    {
        config(['services.netpostpanel.url' => 'http://127.0.0.1:8080']);

        Http::preventStrayRequests();
        Http::fake([
            '127.0.0.1:8080/api/v1/translate' => Http::response([
                'status' => 'succeeded',
                'payload' => ['name' => 'Hi'],
            ]),
        ]);

        (new NetPostPanelClient)->translateContent([
            'source_content' => ['name' => 'Hello'],
            'target_locale' => 'en',
            'translation_mode' => 'literal',
        ]);

        Http::assertSent(fn ($request) => $request->header('Host') === ['127.0.0.1:8080']);
    }

    public function test_it_returns_the_generated_payload(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            '*/api/v1/generate' => Http::response([
                'status' => 'succeeded',
                'payload' => ['name' => 'Generated'],
            ]),
        ]);

        $response = (new NetPostPanelClient)->generateContent([
            'entity_type' => 'post',
            'user_prompt' => 'Test',
            'locale' => 'en',
        ]);

        $this->assertSame('Generated', $response['payload']['name']);
    }
}
