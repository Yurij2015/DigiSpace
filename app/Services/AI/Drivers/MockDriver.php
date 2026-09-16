<?php

namespace App\Services\AI\Drivers;

use App\Services\AI\Contracts\ContentGenerator;

class MockDriver implements ContentGenerator
{
    /**
     * @var array<string, mixed>|null
     */
    protected ?array $cannedResponse = null;

    /**
     * Set a fixed canned response for testing.
     *
     * @param  array<string, mixed>|null  $response
     */
    public function withResponse(?array $response): self
    {
        $this->cannedResponse = $response;

        return $this;
    }

    /**
     * Generate mocked structured content.
     *
     * @return array<string, mixed>
     */
    public function generate(string $prompt, ?string $systemPrompt = null): array
    {
        if ($this->cannedResponse !== null) {
            return $this->cannedResponse;
        }

        // Default mock payload matching standard post and page fields
        return [
            'name' => 'Mock Generated Title: AI & Future of Cloud Computing',
            'content' => '<h2>Introduction</h2><p>This is mock generated content created by DigiSpace AI generator.</p><h3>Key Benefits</h3><ul><li>High performance</li><li>Scalability</li><li>Reliability</li></ul><p>Conclusion and next steps for modern platforms.</p>',
            'description' => 'A comprehensive overview of cloud computing architectures and modern engineering patterns.',
            'keywords' => 'cloud computing, software architecture, scalability, microservices',
            'meta' => 'Cloud Computing Architecture | DigiSpace',
        ];
    }
}
