<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $title
 * @property int|null $level 1, 2, 3 ...
 * @property int|null $position 1, 2, 3 ...
 * @property string|null $description
 * @property string|null $location header, footer...
 * @property string $slug
 * @property string $href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, MenuItem> $menuItem
 * @property-read int|null $menu_item_count
 *
 * @method static Builder<static>|Menu newModelQuery()
 * @method static Builder<static>|Menu newQuery()
 * @method static Builder<static>|Menu query()
 * @method static Builder<static>|Menu whereCreatedAt($value)
 * @method static Builder<static>|Menu whereDescription($value)
 * @method static Builder<static>|Menu whereHref($value)
 * @method static Builder<static>|Menu whereId($value)
 * @method static Builder<static>|Menu whereLevel($value)
 * @method static Builder<static>|Menu whereLocation($value)
 * @method static Builder<static>|Menu whereName($value)
 * @method static Builder<static>|Menu wherePosition($value)
 * @method static Builder<static>|Menu whereSlug($value)
 * @method static Builder<static>|Menu whereTitle($value)
 * @method static Builder<static>|Menu whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Menu extends Model
{
    protected $fillable = [
        'name', 'title', 'level', 'position', 'description', 'location', 'slug', 'href',
    ];

    public function menuItem(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
