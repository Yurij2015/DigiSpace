<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property string $slug
 * @property int $id
 * @property int|null $menu_id
 * @property string|null $name
 * @property string|null $href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Menu> $menus
 * @property-read int|null $menus_count
 * @property-read Collection<int, Page> $pages
 * @property-read int|null $pages_count
 *
 * @method static Builder<static>|MenuItem newModelQuery()
 * @method static Builder<static>|MenuItem newQuery()
 * @method static Builder<static>|MenuItem query()
 * @method static Builder<static>|MenuItem whereCreatedAt($value)
 * @method static Builder<static>|MenuItem whereHref($value)
 * @method static Builder<static>|MenuItem whereId($value)
 * @method static Builder<static>|MenuItem whereMenuId($value)
 * @method static Builder<static>|MenuItem whereName($value)
 * @method static Builder<static>|MenuItem whereSlug($value)
 * @method static Builder<static>|MenuItem whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class MenuItem extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}.
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['name'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'translations',
        'name', 'slug', 'href', 'menu_id',
    ];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    protected function name(): Attribute
    {
        return $this->localizedAttribute('name');
    }
}
