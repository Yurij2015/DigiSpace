<?php

namespace App\Services\AI\Drivers;

use App\Services\AI\Contracts\ContentGenerator;
use App\Services\AI\Support\JsonExtractor;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAiDriver implements ContentGenerator
{
    public function __construct(
        protected string $apiKey,
        protected string $model = 'gpt-4o-mini',
        protected string $baseUrl = 'https://api.openai.com/v1',
    ) {}

    /**
     * Generate structured content using OpenAI Chat Completions API.
     *
     * @return array<string, mixed>
     */
    public function generate(string $prompt, ?string $systemPrompt = null): array
    {
        if (empty($this->apiKey)) {
            throw new RuntimeException('OpenAI API key is not configured.');
        }

        $url = rtrim($this->baseUrl, '/').'/chat/completions';

        $messages = [];
        if (! empty($systemPrompt)) {
            $messages[] = [
                'role' => 'system',
                'content' => $systemPrompt,
            ];
        }

        $messages[] = [
            'role' => 'user',
            'content' => $prompt,
        ];

        $payload = [
            'model' => $this->model,
            'messages' => $messages,
            'response_format' => ['type' => 'json_object'],
            'temperature' => 0.7,
        ];

        $response = Http::timeout(60)
            ->withToken($this->apiKey)
            ->post($url, $payload);

        if ($response->failed()) {
            $errorMsg = $response->json('error.message') ?? $response->body();
            throw new RuntimeException("OpenAI API request failed ({$response->status()}): {$errorMsg}");
        }

        $text = $response->json('choices.0.message.content');

        if (empty($text)) {
            throw new RuntimeException('OpenAI returned an empty response.');
        }

        return JsonExtractor::extract($text);
    }
}
