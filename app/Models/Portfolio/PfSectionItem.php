<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
