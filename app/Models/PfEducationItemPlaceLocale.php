<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfEducationItemPlaceLocale
 *
 * @property int $id
 * @property int $education_item_place_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducationItemPlace $pfEducationItemPlace
 * @method static Builder|PfEducationItemPlaceLocale newModelQuery()
 * @method static Builder|PfEducationItemPlaceLocale newQuery()
 * @method static Builder|PfEducationItemPlaceLocale query()
 * @method static Builder|PfEducationItemPlaceLocale whereCreatedAt($value)
 * @method static Builder|PfEducationItemPlaceLocale whereDescription($value)
 * @method static Builder|PfEducationItemPlaceLocale whereEducationItemPlaceId($value)
 * @method static Builder|PfEducationItemPlaceLocale whereId($value)
 * @method static Builder|PfEducationItemPlaceLocale whereLocale($value)
 * @method static Builder|PfEducationItemPlaceLocale whereTitle($value)
 * @method static Builder|PfEducationItemPlaceLocale whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PfEducationItemPlaceLocale extends Model
{

    protected $fillable = [
        'education_item_place_id',
        'locale',
        'title',
        'description',
    ];

    public function pfEducationItemPlace(): BelongsTo
    {
        return $this->belongsTo(PfEducationItemPlace::class, 'education_item_place_id', 'id');
    }
}
