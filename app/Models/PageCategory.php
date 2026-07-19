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
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Page> $page
 * @property-read int|null $page_count
 *
 * @method static Builder<static>|PageCategory newModelQuery()
 * @method static Builder<static>|PageCategory newQuery()
 * @method static Builder<static>|PageCategory query()
 * @method static Builder<static>|PageCategory whereCreatedAt($value)
 * @method static Builder<static>|PageCategory whereDescription($value)
 * @method static Builder<static>|PageCategory whereId($value)
 * @method static Builder<static>|PageCategory whereName($value)
 * @method static Builder<static>|PageCategory whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PageCategory extends Model
{
    public function page(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
