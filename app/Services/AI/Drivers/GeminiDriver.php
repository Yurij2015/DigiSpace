<?php

namespace App\Services\AI\Drivers;

use App\Services\AI\Contracts\ContentGenerator;
use App\Services\AI\Support\JsonExtractor;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GeminiDriver implements ContentGenerator
{
    public function __construct(
        protected string $apiKey,
        protected string $model = 'gemini-2.5-flash',
        protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta',
    ) {}

    /**
     * Generate structured content using Google Gemini API.
     *
     * @return array<string, mixed>
     */
    public function generate(string $prompt, ?string $systemPrompt = null): array
    {
        if (empty($this->apiKey)) {
            throw new RuntimeException('Gemini API key is not configured.');
        }

        $url = rtrim($this->baseUrl, '/')."/models/{$this->model}:generateContent?key={$this->apiKey}";

        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
                'temperature' => 0.7,
            ],
        ];

        if (! empty($systemPrompt)) {
            $payload['systemInstruction'] = [
                'parts' => [
                    ['text' => $systemPrompt],
                ],
            ];
        }

        $response = Http::timeout(60)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $payload);

        if ($response->failed()) {
            $errorMsg = $response->json('error.message') ?? $response->body();
            throw new RuntimeException("Gemini API request failed ({$response->status()}): {$errorMsg}");
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        if (empty($text)) {
            throw new RuntimeException('Gemini returned an empty response.');
        }

        return JsonExtractor::extract($text);
    }
}
