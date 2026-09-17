<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NetPostPanelClient
{
    /**
     * @return array<string, mixed>
     */
    public function generateContent(array $payload): array
    {
        return $this->sendRequest('/api/v1/generate', $payload);
    }

    /**
     * @return array<string, mixed>
     */
    public function translateContent(array $payload): array
    {
        return $this->sendRequest('/api/v1/translate', $payload);
    }

    /**
     * @return array<string, mixed>
     */
    protected function sendRequest(string $endpoint, array $payload): array
    {
        $url = rtrim(config('services.netpostpanel.url', 'https://net-post-panel.digispace.pro'), '/');
        $apiKey = config('services.netpostpanel.key');

        if (empty($apiKey)) {
            throw new RuntimeException('NetPostPanel API key is not configured. Set NETPOSTPANEL_API_KEY in the .env file, then run `php artisan config:clear`.');
        }

        $response = Http::withHeaders(['X-API-KEY' => $apiKey])
            ->acceptJson()
            ->timeout(120) // RAG can take a while
            ->post($url.$endpoint, $payload);

        if ($response->failed()) {
            throw new RuntimeException('Failed to communicate with NetPostPanel API: '.$response->body());
        }

        $data = $response->json();

        if (! isset($data['payload']) || ! is_array($data['payload'])) {
            throw new RuntimeException('Invalid response format from NetPostPanel API.');
        }

        return $data['payload'];
    }
}
