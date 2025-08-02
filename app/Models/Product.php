<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $title
 * @property float|null $price_value
 * @property string|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Service> $services
 * @property-read int|null $services_count
 *
 * @method static Builder<static>|Product newModelQuery()
 * @method static Builder<static>|Product newQuery()
 * @method static Builder<static>|Product query()
 * @method static Builder<static>|Product whereCreatedAt($value)
 * @method static Builder<static>|Product whereDetails($value)
 * @method static Builder<static>|Product whereId($value)
 * @method static Builder<static>|Product wherePriceValue($value)
 * @method static Builder<static>|Product whereTitle($value)
 * @method static Builder<static>|Product whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'title', 'details', 'price_value',
    ];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
