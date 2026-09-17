<?php

namespace App\Models\Concerns;

use App\Models\GenerationAttempt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Provides a polymorphic relationship to AI generation attempts.
 *
 * @mixin Model
 */
trait HasGenerationAttempts
{
    public function generationAttempts(): MorphMany
    {
        return $this->morphMany(GenerationAttempt::class, 'generatable')
            ->orderByDesc('created_at');
    }

    public function nextAttemptNumber(string $entityType): int
    {
        return (int) $this->generationAttempts()
            ->where('entity_type', $entityType)
            ->max('attempt_number') + 1;
    }
}
