<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @mixin Eloquent
 */
class MenuItem extends Model
{
    protected $fillable = [
        'name', 'slug', 'href'
    ];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
