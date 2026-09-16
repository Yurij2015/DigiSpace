<?php

namespace App\Services\AI;

class ArticlePromptBuilder
{
    /**
     * Build system and user prompt for article or page generation.
     *
     * @param  array<int, string>  $fields
     * @param  array<int, string>  $seoFields
     * @return array{system_prompt: string, prompt: string}
     */
    public function build(
        string $entityDescription,
        array $fields,
        array $seoFields,
        string $userPrompt,
        string $locale = 'en',
        string $writingStyle = 'Professional',
        ?string $keywords = null,
        ?string $systemPrompt = null
    ): array {
        $allFields = array_values(array_unique(array_merge($fields, $seoFields)));

        $localeInstruction = match (strtolower($locale)) {
            'uk' => 'Мова написання: Українська. Використовуй живу, багату, природну українську мову з сучасною термінологією, правильними відмінковими закінченнями та без кальок з російської чи англійської.',
            'pl' => 'Język tworzenia: Polski. Używaj naturalnego, płynnego języka polskiego z poprawną deklinacją, zasadami interpunkcji i trafnymi polskimi idiomami branżowymi.',
            default => 'Target language: English. Use clear, engaging, professional, and idiomatic English.',
        };

        $styleInstruction = match (ucfirst(strtolower($writingStyle))) {
            'Engaging' => 'Tone: Highly engaging, conversational, compelling, and hook-driven to maximize reader retention.',
            'Informative' => 'Tone: Deeply informative, balanced, clear, and focused on providing practical, structured knowledge.',
            'Casual' => 'Tone: Friendly, approachable, relaxed, and accessible to a general audience.',
            'Technical' => 'Tone: Authoritative, precise, technical, with clear domain accuracy and structured insights.',
            default => 'Tone: Professional, polished, authoritative, and well-structured.',
        };

        $resolvedSystemPrompt = trim(implode("\n\n", array_filter([
            $systemPrompt ?: 'You are an expert content creator, technical copywriter, and SEO specialist.',
            "Entity Context:\n{$entityDescription}",
            "Formatting Rules:\n- Format the 'content' body in clean, semantic HTML (<h2>, <h3>, <p>, <ul>, <ol>, <li>, <blockquote>, <strong>, <code>).\n- Do NOT output full <html>, <head>, or <body> tags.\n- Do NOT wrap your output in markdown code blocks like ```json or ```html.\n- Your entire response MUST be a single, valid JSON object.",
            "Required JSON Schema:\nKeys must be strictly: ".json_encode($allFields),
        ])));

        $promptParts = [
            "Entity Role & Purpose: {$entityDescription}",
            "Target Locale: {$locale} ({$localeInstruction})",
            "Writing Style: {$styleInstruction}",
        ];

        if (! empty($keywords)) {
            $promptParts[] = "SEO Keywords to naturally incorporate: {$keywords}";
        }

        $promptParts[] = "Content Prompt / Topic Directive:\n{$userPrompt}";

        $schemaExample = [];
        foreach ($allFields as $field) {
            $schemaExample[$field] = "Generated {$field} value";
        }

        $promptParts[] = "Output Requirement:\nReturn ONLY a JSON object matching this structure:\n".json_encode($schemaExample, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return [
            'system_prompt' => $resolvedSystemPrompt,
            'prompt' => implode("\n\n", $promptParts),
        ];
    }
}
