<?php

namespace App\Services\AI\Support;

use RuntimeException;

class JsonExtractor
{
    /**
     * Clean and decode JSON text returned from LLM.
     *
     * @return array<string, mixed>
     */
    public static function extract(string $text): array
    {
        $cleaned = trim($text);

        // Strip ```json ... ``` or ``` ... ```
        if (preg_match('/```(?:json)?\s*([\s\S]*?)\s*```/i', $cleaned, $matches)) {
            $cleaned = trim($matches[1]);
        }

        // Extract substring between the first { and the last }
        $firstBrace = strpos($cleaned, '{');
        $lastBrace = strrpos($cleaned, '}');

        if ($firstBrace !== false && $lastBrace !== false && $lastBrace > $firstBrace) {
            $cleaned = substr($cleaned, $firstBrace, $lastBrace - $firstBrace + 1);
        }

        $decoded = json_decode($cleaned, true);

        if (! is_array($decoded)) {
            throw new RuntimeException('Failed to decode JSON from AI response: '.json_last_error_msg()."\nRaw response was:\n".substr($text, 0, 500));
        }

        return $decoded;
    }
}
