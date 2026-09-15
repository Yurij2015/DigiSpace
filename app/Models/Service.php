<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $title
 * @property string|null $details
 * @property float|null $price
 * @property int|null $service_category_id
 * @property string|null $seo_keywords
 * @property string|null $seo_description
 * @property string|null $seo_title
 * @property string|null $image_alt
 * @property string|null $image
 * @property string|null $description
 * @property string|null $slug
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ServiceCategory|null $serviceCategory
 *
 * @method static Builder<static>|Service newModelQuery()
 * @method static Builder<static>|Service newQuery()
 * @method static Builder<static>|Service query()
 * @method static Builder<static>|Service whereCreatedAt($value)
 * @method static Builder<static>|Service whereDescription($value)
 * @method static Builder<static>|Service whereDetails($value)
 * @method static Builder<static>|Service whereId($value)
 * @method static Builder<static>|Service whereImage($value)
 * @method static Builder<static>|Service whereImageAlt($value)
 * @method static Builder<static>|Service wherePrice($value)
 * @method static Builder<static>|Service whereSeoDescription($value)
 * @method static Builder<static>|Service whereSeoKeywords($value)
 * @method static Builder<static>|Service whereSeoTitle($value)
 * @method static Builder<static>|Service whereServiceCategoryId($value)
 * @method static Builder<static>|Service whereSlug($value)
 * @method static Builder<static>|Service whereStatus($value)
 * @method static Builder<static>|Service whereTitle($value)
 * @method static Builder<static>|Service whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Service extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}; read by the
     * control-panel edit pages so forms are filled from raw values (see FillsRawTranslatableFields).
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['title', 'details', 'description', 'seo_keywords', 'seo_description', 'seo_title', 'image_alt'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'title', 'details', 'price', 'service_category_id', 'seo_keywords', 'seo_description', 'seo_title', 'image_alt', 'description', 'slug', 'image', 'status', 'translations',
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

    protected function description(): Attribute
    {
        return $this->localizedAttribute('description');
    }

    protected function seoKeywords(): Attribute
    {
        return $this->localizedAttribute('seo_keywords');
    }

    protected function seoDescription(): Attribute
    {
        return $this->localizedAttribute('seo_description');
    }

    protected function seoTitle(): Attribute
    {
        return $this->localizedAttribute('seo_title');
    }

    protected function imageAlt(): Attribute
    {
        return $this->localizedAttribute('image_alt');
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value ? '/uploads/'.$value : '/uploads/no_image.png'
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function serviceStyle(): HasOne|Builder|Service
    {
        return $this->hasOne(ProductService::class, 'service_id', 'id');
    }
}
