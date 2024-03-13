<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfEducationItemPlace
 *
 * @property int $id
 * @property int $education_item_id
 * @property string $logoUrl
 * @property string $faIcon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducationItem $pfEducationItem
 * @property-read Collection<int, PfEducationItemPlaceLocale> $pfEducationItemPlaceLocale
 * @property-read int|null $pf_education_item_place_locale_count
 * @method static Builder|PfEducationItemPlace newModelQuery()
 * @method static Builder|PfEducationItemPlace newQuery()
 * @method static Builder|PfEducationItemPlace query()
 * @method static Builder|PfEducationItemPlace whereCreatedAt($value)
 * @method static Builder|PfEducationItemPlace whereEducationItemId($value)
 * @method static Builder|PfEducationItemPlace whereFaIcon($value)
 * @method static Builder|PfEducationItemPlace whereId($value)
 * @method static Builder|PfEducationItemPlace whereLogoUrl($value)
 * @method static Builder|PfEducationItemPlace whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PfEducationItemPlace extends Model
{
    protected $fillable = [
        'education_item_id',
        'logoUrl',
        'faIcon',
    ];

    public function pfEducationItem(): BelongsTo
    {
        return $this->belongsTo(PfEducationItem::class, 'education_item_id', 'id');
    }

    public function pfEducationItemPlaceLocale(): HasMany
    {
        return $this->hasMany(PfEducationItemPlaceLocale::class, 'education_item_place_id', 'id');
    }

}
