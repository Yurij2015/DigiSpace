<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NetPostPanelClient
{
    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    public function generateContent(array $payload): array
    {
        $response = $this->sendRequest('POST', '/api/v1/generate', $payload);

        $this->assertSyncPayload($response);

        return $response;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    public function translateContent(array $payload): array
    {
        $response = $this->sendRequest('POST', '/api/v1/translate', $payload);

        $this->assertSyncPayload($response);

        return $response;
    }

    /**
     * @return array<string, mixed>
     */
    public function getGenerationResult(string $requestId): array
    {
        return $this->sendRequest('GET', "/api/v1/generate/{$requestId}");
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    protected function sendRequest(string $method, string $endpoint, array $payload = []): array
    {
        $url = rtrim(config('services.netpostpanel.url', 'https://net-post-panel.digispace.pro'), '/');
        $apiKey = config('services.netpostpanel.key');

        if (empty($apiKey)) {
            throw new RuntimeException('NetPostPanel API key is not configured. Set NETPOSTPANEL_API_KEY in the .env file, then run `php artisan config:clear`.');
        }

        $request = Http::withHeaders(['X-API-KEY' => $apiKey])
            ->acceptJson()
            ->asJson()
            ->timeout(120); // RAG can take a while

        $response = $method === 'GET'
            ? $request->get($url.$endpoint)
            : $request->post($url.$endpoint, $payload);

        if ($response->status() === 429) {
            throw new NetPostPanelRateLimitedException(
                retryAfterSeconds: $response->header('Retry-After') !== null
                    ? (int) $response->header('Retry-After')
                    : null
            );
        }

        if ($response->failed()) {
            throw new RuntimeException('Failed to communicate with NetPostPanel API: '.$response->body());
        }

        return $response->json();
    }

    /**
     * @param  array<string, mixed>  $response
     */
    protected function assertSyncPayload(array $response): void
    {
        $isPending = ($response['status'] ?? null) === 'pending';
        $hasPayload = isset($response['payload']) && is_array($response['payload']);

        if (! $isPending && ! $hasPayload) {
            throw new RuntimeException('Invalid response format from NetPostPanel API.');
        }
    }
}
