<?php

namespace App\Services\AI;

class TranslationPromptBuilder
{
    /**
     * Build system and user prompt for translating content from English to target locale.
     *
     * @param  array<int, string>  $fields
     * @param  array<int, string>  $seoFields
     * @param  array<string, mixed>  $sourceContent
     * @return array{system_prompt: string, prompt: string}
     */
    public function build(
        string $entityDescription,
        array $fields,
        array $seoFields,
        array $sourceContent,
        string $targetLocale,
        string $translationMode = 'adapted',
        ?string $systemPrompt = null
    ): array {
        $allFields = array_values(array_unique(array_merge($fields, $seoFields)));

        $localeInstruction = match (strtolower($targetLocale)) {
            'uk' => 'Target language: Ukrainian (Українська). Ensure natural Ukrainian phrasing, modern IT/business vocabulary, correct nominal/verbal government and grammatical cases (відмінки), avoid literal calques from Russian or English, and adhere to official Ukrainian orthography (Український правопис).',
            'pl' => 'Target language: Polish (Polski). Ensure fluent and natural Polish phrasing, precise Polish declensions (odmiana przez przypadki), correct punctuation, and natural technical or marketing idioms.',
            default => "Target language: {$targetLocale}. Translate accurately and idiomatically for native readers.",
        };

        $modeInstruction = match (strtolower($translationMode)) {
            'literal' => 'Translation Mode: Literal (Faithful translation). Preserve the exact meaning, technical terminology, sentence progression, and structural layout of the source text as closely as possible while maintaining grammatical correctness in the target language.',
            default => 'Translation Mode: Adapted (Cultural adaptation & localization). Rewrite and localize the content naturally for the target language market and audience. Adapt idioms, cultural nuances, phrasing, and SEO keywords so that it feels natively written for this language, while preserving all core facts, key takeaways, and messaging.',
        };

        $resolvedSystemPrompt = trim(implode("\n\n", array_filter([
            $systemPrompt ?: 'You are a professional localization specialist, native-level translator, and SEO copywriter.',
            "Entity Context:\n{$entityDescription}",
            "Rules & Formatting:\n- {$modeInstruction}\n- {$localeInstruction}\n- For HTML content fields, preserve semantic HTML tags (<h2>, <h3>, <p>, <ul>, <ol>, <li>, <blockquote>, <strong>, <code>, etc.).\n- Do NOT include full document tags (<html>, <body>) or markdown code fences like ```json.\n- Return ONLY a valid JSON object matching the requested fields.",
            "Required JSON Keys:\n".json_encode($allFields),
        ])));

        $promptParts = [
            "Entity Description: {$entityDescription}",
            "Target Locale: {$targetLocale}",
            $modeInstruction,
            $localeInstruction,
            "Source English Content to Translate:\n".json_encode($sourceContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        ];

        $schemaExample = [];
        foreach ($allFields as $field) {
            $schemaExample[$field] = "Translated {$field} in {$targetLocale}";
        }

        $promptParts[] = "Output Requirement:\nReturn a JSON object containing the translated values for all requested fields:\n".json_encode($schemaExample, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return [
            'system_prompt' => $resolvedSystemPrompt,
            'prompt' => implode("\n\n", $promptParts),
        ];
    }
}
