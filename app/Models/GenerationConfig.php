<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $entity_type
 * @property string $entity_name
 * @property string $entity_description
 * @property array<int, string> $fields
 * @property array<int, string> $seo_fields
 * @property string|null $default_prompt
 * @property string|null $system_prompt
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|GenerationConfig newModelQuery()
 * @method static Builder<static>|GenerationConfig newQuery()
 * @method static Builder<static>|GenerationConfig query()
 * @method static Builder<static>|GenerationConfig whereEntityType($value)
 *
 * @mixin Eloquent
 */
class GenerationConfig extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_name',
        'entity_description',
        'fields',
        'seo_fields',
        'default_prompt',
        'system_prompt',
    ];

    protected function casts(): array
    {
        return [
            'fields' => 'array',
            'seo_fields' => 'array',
        ];
    }
}
