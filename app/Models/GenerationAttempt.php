<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $request_id
 * @property string|null $status
 * @property string $type
 * @property string $entity_type
 * @property string|null $generatable_type
 * @property int|null $generatable_id
 * @property int $attempt_number
 * @property string $locale
 * @property string|null $translation_mode
 * @property string $user_prompt
 * @property string $resolved_prompt
 * @property array<string, mixed>|null $source_content
 * @property array<string, mixed>|null $generated_payload
 * @property array<string, mixed>|null $rag_sources
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property-read Model|null $generatable
 * @property-read User|null $creator
 *
 * @method static Builder<static>|GenerationAttempt newModelQuery()
 * @method static Builder<static>|GenerationAttempt newQuery()
 * @method static Builder<static>|GenerationAttempt query()
 * @method static Builder<static>|GenerationAttempt whereEntityType($value)
 * @method static Builder<static>|GenerationAttempt whereType($value)
 *
 * @mixin Eloquent
 */
class GenerationAttempt extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'request_id',
        'status',
        'type',
        'entity_type',
        'generatable_type',
        'generatable_id',
        'attempt_number',
        'locale',
        'translation_mode',
        'user_prompt',
        'resolved_prompt',
        'source_content',
        'generated_payload',
        'rag_sources',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'source_content' => 'array',
            'generated_payload' => 'array',
            'rag_sources' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function generatable(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
