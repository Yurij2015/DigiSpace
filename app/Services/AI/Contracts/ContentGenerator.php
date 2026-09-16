<?php

namespace App\Services\AI\Contracts;

interface ContentGenerator
{
    /**
     * Generate structured content based on prompt and optional system prompt.
     *
     * @return array<string, mixed>
     */
    public function generate(string $prompt, ?string $systemPrompt = null): array;
}
