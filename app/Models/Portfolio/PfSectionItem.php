<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfSectionItem
 *
 * @property int $id
 * @property int|null $section_id
 * @property int|null $subcategory_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $title
 * @property int|null $place_id
 * @property mixed|null $period
 * @property string|null $image_icon_url
 * @property string|null $fa_icon
 * @property string|null $value
 * @property string|null $logo_url
 * @property string|null $href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PfSectionItem newModelQuery()
 * @method static Builder|PfSectionItem newQuery()
 * @method static Builder|PfSectionItem query()
 * @method static Builder|PfSectionItem whereCreatedAt($value)
 * @method static Builder|PfSectionItem whereFaIcon($value)
 * @method static Builder|PfSectionItem whereHref($value)
 * @method static Builder|PfSectionItem whereId($value)
 * @method static Builder|PfSectionItem whereImageIconUrl($value)
 * @method static Builder|PfSectionItem whereLogoUrl($value)
 * @method static Builder|PfSectionItem whereName($value)
 * @method static Builder|PfSectionItem wherePeriod($value)
 * @method static Builder|PfSectionItem wherePlaceId($value)
 * @method static Builder|PfSectionItem whereSectionId($value)
 * @method static Builder|PfSectionItem whereSlug($value)
 * @method static Builder|PfSectionItem whereSubcategoryId($value)
 * @method static Builder|PfSectionItem whereTitle($value)
 * @method static Builder|PfSectionItem whereUpdatedAt($value)
 * @method static Builder|PfSectionItem whereValue($value)
 *
 * @property-read Collection<int, PfLink> $links
 * @property-read int|null $links_count
 * @property-read Collection<int, PfLocale> $locales
 * @property-read int|null $locales_count
 * @property-read PfPlace|null $place
 * @property-read PfSection|null $section
 * @property-read PfSubcategory|null $subcategory
 *
 * @mixin Eloquent
 */
class PfSectionItem extends Model
{
    protected $fillable = [
        'section_id',
        'subcategory_id',
        'name',
        'slug',
        'title',
        'place_id',
        'period',
        'image_icon_url',
        'fa_icon',
        'value',
        'logo_url',
        'href',
    ];

    protected $casts = [
        'period' => 'array',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PfSection::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(PfSubcategory::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(PfPlace::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(PfLink::class, 'item_id');
    }

    public function locales(): HasMany
    {
        return $this->hasMany(PfLocale::class, 'item_id');
    }
}
