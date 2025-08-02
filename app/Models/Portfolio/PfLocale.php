<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfLocale
 *
 * @property int $id
 * @property int|null $section_id
 * @property int|null $item_id
 * @property int|null $place_id
 * @property int|null $subcategory_id
 * @property int|null $en_id
 * @property int|null $ua_id
 * @property int|null $pl_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfLocale newModelQuery()
 * @method static Builder|PfLocale newQuery()
 * @method static Builder|PfLocale query()
 * @method static Builder|PfLocale whereCreatedAt($value)
 * @method static Builder|PfLocale whereEnId($value)
 * @method static Builder|PfLocale whereId($value)
 * @method static Builder|PfLocale whereItemId($value)
 * @method static Builder|PfLocale wherePlId($value)
 * @method static Builder|PfLocale wherePlaceId($value)
 * @method static Builder|PfLocale whereSectionId($value)
 * @method static Builder|PfLocale whereSubcategoryId($value)
 * @method static Builder|PfLocale whereUaId($value)
 * @method static Builder|PfLocale whereUpdatedAt($value)
 * @property-read PfLanguage|null $en
 * @property-read PfLanguage|null $pl
 * @property-read PfPlace|null $place
 * @property-read PfSection|null $section
 * @property-read PfSectionItem|null $sectionItem
 * @property-read PfSubcategory|null $subcategory
 * @property-read PfLanguage|null $ua
 * @mixin Eloquent
 */
class PfLocale extends Model
{
    protected $fillable = ['section_id', 'item_id', 'place_id', 'subcategory_id', 'en_id', 'ua_id', 'pl_id'];

    public function sectionItem(): BelongsTo
    {
        return $this->belongsTo(PfSectionItem::class, 'item_id', 'id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(PfSection::class, 'section_id', 'id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(PfPlace::class, 'place_id', 'id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(PfSubcategory::class, 'subcategory_id', 'id');
    }

    public function en(): BelongsTo
    {
        return $this->belongsTo(PfLanguage::class, 'en_id', 'id');
    }

    public function ua(): BelongsTo
    {
        return $this->belongsTo(PfLanguage::class, 'ua_id', 'id');
    }

    public function pl(): BelongsTo
    {
        return $this->belongsTo(PfLanguage::class, 'pl_id', 'id');
    }
}
