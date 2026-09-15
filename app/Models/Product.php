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
class Product extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}; read by the
     * control-panel edit pages so forms are filled from raw values (see FillsRawTranslatableFields).
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['title', 'details', 'product_name', 'description'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'title', 'details', 'price_value', 'product_code', 'product_name', 'description', 'is_active', 'position', 'is_prefered', 'translations',
    ];

    protected function casts(): array
    {
        return [];
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
