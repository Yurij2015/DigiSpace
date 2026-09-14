<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    use HasLocalizedContent;

    protected $fillable = [
        'title', 'details', 'price_value', 'product_code', 'product_name', 'description', 'is_active', 'position', 'is_prefered', 'translations',
    ];

    protected function casts(): array
    {
        return ['translations' => 'array'];
    }

    protected function title(): Attribute
    {
        return $this->localizedAttribute('title');
    }

    protected function details(): Attribute
    {
        return $this->localizedAttribute('details');
    }

    protected function productName(): Attribute
    {
        return $this->localizedAttribute('product_name');
    }

    protected function description(): Attribute
    {
        return $this->localizedAttribute('description');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
