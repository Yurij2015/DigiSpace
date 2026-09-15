<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * @property string|null $slug
 * @property-read Collection<int, Post> $post
 * @property-read int|null $post_count
 * @property-read User|null $user
 *
 * @method static Builder<static>|Category newModelQuery()
 * @method static Builder<static>|Category newQuery()
 * @method static Builder<static>|Category query()
 * @method static Builder<static>|Category whereCreatedAt($value)
 * @method static Builder<static>|Category whereDeletedAt($value)
 * @method static Builder<static>|Category whereDescription($value)
 * @method static Builder<static>|Category whereId($value)
 * @method static Builder<static>|Category whereName($value)
 * @method static Builder<static>|Category whereSlug($value)
 * @method static Builder<static>|Category whereUpdatedAt($value)
 * @method static Builder<static>|Category whereUserId($value)
 *
 * @mixin Eloquent
 */
class Category extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}; read by the
     * control-panel edit pages so forms are filled from raw values (see FillsRawTranslatableFields).
     *
     * @var list<string>
     */
    public const array TRANSLATABLE = ['name', 'description'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'name', 'description', 'slug', 'user_id', 'translations',
    ];

    protected function casts(): array
    {
        return [];
    }

    protected function name(): Attribute
    {
        return $this->localizedAttribute('name');
    }

    protected function description(): Attribute
    {
        return $this->localizedAttribute('description');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
