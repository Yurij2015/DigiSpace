<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\ContentGenerator;
use App\Services\AI\Drivers\GeminiDriver;
use App\Services\AI\Drivers\MockDriver;
use App\Services\AI\Drivers\OpenAiDriver;
use Illuminate\Support\Manager;

class AiManager extends Manager
{
    /**
     * Get the default driver name.
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('ai.default', 'gemini');
    }

    /**
     * Create the Gemini driver instance.
     */
    public function createGeminiDriver(): ContentGenerator
    {
        $config = $this->config->get('ai.drivers.gemini', []);
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey) && ! app()->isProduction()) {
            return $this->createMockDriver();
        }

        return new GeminiDriver(
            apiKey: $apiKey,
            model: $config['model'] ?? 'gemini-2.5-flash',
            baseUrl: $config['base_url'] ?? 'https://generativelanguage.googleapis.com/v1beta',
        );
    }

    /**
     * Create the OpenAI driver instance.
     */
    public function createOpenaiDriver(): ContentGenerator
    {
        $config = $this->config->get('ai.drivers.openai', []);
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey) && ! app()->isProduction()) {
            return $this->createMockDriver();
        }

        return new OpenAiDriver(
            apiKey: $apiKey,
            model: $config['model'] ?? 'gpt-4o-mini',
            baseUrl: $config['base_url'] ?? 'https://api.openai.com/v1',
        );
    }

    /**
     * Create the Mock driver instance.
     */
    public function createMockDriver(): ContentGenerator
    {
        return new MockDriver;
    }
}
