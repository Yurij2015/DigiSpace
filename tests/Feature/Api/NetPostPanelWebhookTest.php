<?php

namespace Tests\Feature\Api;

use App\Models\GenerationAttempt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NetPostPanelWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_webhook_updates_attempt_on_completion(): void
    {
        $attempt = GenerationAttempt::create([
            'request_id' => 'req-uuid-1',
            'status' => 'pending',
            'type' => 'generation',
            'entity_type' => 'post',
            'attempt_number' => 1,
            'locale' => 'en',
            'user_prompt' => 'Test prompt',
            'resolved_prompt' => 'Sent to NetPostPanel RAG API',
            'generated_payload' => [],
        ]);

        $response = $this->postJson('/api/hooks/netpostpanel', [
            'request_id' => 'req-uuid-1',
            'status' => 'succeeded',
            'result' => ['name' => 'Done', 'content' => 'Content'],
            'error' => null,
        ]);

        $response->assertOk()->assertJson(['ok' => true]);

        $attempt->refresh();
        $this->assertEquals('succeeded', $attempt->status);
        $this->assertEquals(['name' => 'Done', 'content' => 'Content'], $attempt->generated_payload);
    }

    public function test_webhook_marks_attempt_failed(): void
    {
        $attempt = GenerationAttempt::create([
            'request_id' => 'req-uuid-2',
            'status' => 'pending',
            'type' => 'generation',
            'entity_type' => 'post',
            'attempt_number' => 1,
            'locale' => 'en',
            'user_prompt' => 'Test prompt',
            'resolved_prompt' => 'Sent to NetPostPanel RAG API',
            'generated_payload' => [],
        ]);

        $response = $this->postJson('/api/hooks/netpostpanel', [
            'request_id' => 'req-uuid-2',
            'status' => 'failed',
            'result' => null,
            'error' => 'Provider rate limited',
        ]);

        $response->assertOk();

        $attempt->refresh();
        $this->assertEquals('failed', $attempt->status);
    }

    public function test_webhook_returns_404_for_unknown_request_id(): void
    {
        $response = $this->postJson('/api/hooks/netpostpanel', [
            'request_id' => 'unknown-uuid',
            'status' => 'succeeded',
            'result' => ['name' => 'Done'],
        ]);

        $response->assertNotFound();
    }

    public function test_webhook_returns_422_without_request_id(): void
    {
        $response = $this->postJson('/api/hooks/netpostpanel', [
            'status' => 'succeeded',
        ]);

        $response->assertUnprocessable();
    }
}
