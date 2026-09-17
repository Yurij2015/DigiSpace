<?php

namespace App\Services\AI;

use App\Models\GenerationAttempt;
use App\Models\GenerationConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ContentGeneratorService
{
    public function __construct(
        protected NetPostPanelClient $apiClient
    ) {}

    /**
     * Generate content for an entity based on configuration and prompt directives.
     *
     * @return array<string, mixed>
     */
    public function generate(
        string $entityType,
        string $userPrompt,
        string $locale = 'en',
        string $writingStyle = 'Professional',
        ?string $keywords = null,
        ?Model $record = null,
        ?int $userId = null,
        ?string $provider = null,
        ?string $model = null,
        bool $async = false,
        ?string $callbackUrl = null,
        ?bool $rag = null,
        ?int $searchResults = null,
        ?int $sources = null,
        ?int $minUsefulnessScore = null,
    ): array {
        $config = GenerationConfig::where('entity_type', $entityType)->firstOrFail();

        $payloadToApi = array_filter([
            'entity_type' => $entityType,
            'entity_description' => $config->entity_description,
            'fields' => $config->fields ?? [],
            'seo_fields' => $config->seo_fields ?? [],
            'system_prompt' => $config->system_prompt,
            'user_prompt' => $userPrompt,
            'locale' => $locale,
            'writing_style' => $writingStyle,
            'keywords' => $keywords,
            'provider' => $provider,
            'model' => $model,
            'async' => $async,
            'callback_url' => $callbackUrl,
            'rag' => $rag,
            'search_results' => $searchResults,
            'sources' => $sources,
            'min_usefulness_score' => $minUsefulnessScore,
        ], fn ($value) => $value !== null);

        $response = $this->apiClient->generateContent($payloadToApi);

        $attemptNumber = 1;
        if ($record && $record->getKey()) {
            $attemptNumber = (int) GenerationAttempt::where('generatable_type', $record->getMorphClass())
                ->where('generatable_id', $record->getKey())
                ->max('attempt_number') + 1;
        }

        GenerationAttempt::create([
            'request_id' => $response['request_id'] ?? null,
            'status' => $response['status'] ?? null,
            'type' => 'generation',
            'entity_type' => $entityType,
            'generatable_type' => $record ? $record->getMorphClass() : null,
            'generatable_id' => $record?->getKey(),
            'attempt_number' => $attemptNumber,
            'locale' => $locale,
            'translation_mode' => null,
            'user_prompt' => $userPrompt,
            'resolved_prompt' => 'Sent to NetPostPanel RAG API',
            'source_content' => null,
            'generated_payload' => $response['payload'] ?? [],
            'rag_sources' => $response['rag_sources'] ?? null,
            'created_by' => $userId ?? Auth::id(),
            'created_at' => now(),
        ]);

        return $response;
    }

    /**
     * Translate existing English content to target locale (uk, pl) with adapted or literal mode.
     *
     * @param  array<string, mixed>  $sourceContent
     * @return array<string, mixed>
     */
    public function translate(
        string $entityType,
        array $sourceContent,
        string $targetLocale,
        string $translationMode = 'adapted',
        ?Model $record = null,
        ?int $userId = null,
        ?string $provider = null,
        ?string $model = null,
        bool $async = false,
        ?string $callbackUrl = null,
    ): array {
        $config = GenerationConfig::where('entity_type', $entityType)->firstOrFail();

        $payloadToApi = array_filter([
            'entity_type' => $entityType,
            'entity_description' => $config->entity_description,
            'fields' => $config->fields ?? [],
            'seo_fields' => $config->seo_fields ?? [],
            'system_prompt' => $config->system_prompt,
            'source_content' => $sourceContent,
            'target_locale' => $targetLocale,
            'translation_mode' => $translationMode,
            'provider' => $provider,
            'model' => $model,
            'async' => $async,
            'callback_url' => $callbackUrl,
        ], fn ($value) => $value !== null);

        $response = $this->apiClient->translateContent($payloadToApi);

        $attemptNumber = 1;
        if ($record && $record->getKey()) {
            $attemptNumber = (int) GenerationAttempt::where('generatable_type', $record->getMorphClass())
                ->where('generatable_id', $record->getKey())
                ->max('attempt_number') + 1;
        }

        GenerationAttempt::create([
            'request_id' => $response['request_id'] ?? null,
            'status' => $response['status'] ?? null,
            'type' => 'translation',
            'entity_type' => $entityType,
            'generatable_type' => $record ? $record->getMorphClass() : null,
            'generatable_id' => $record?->getKey(),
            'attempt_number' => $attemptNumber,
            'locale' => $targetLocale,
            'translation_mode' => $translationMode,
            'user_prompt' => "Translate from English ({$translationMode}) to {$targetLocale}",
            'resolved_prompt' => 'Sent to NetPostPanel Translation API',
            'source_content' => $sourceContent,
            'generated_payload' => $response['payload'] ?? [],
            'created_by' => $userId ?? Auth::id(),
            'created_at' => now(),
        ]);

        return $response;
    }
}
