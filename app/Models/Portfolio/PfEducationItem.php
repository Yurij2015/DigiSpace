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
 * App\Models\PfEducationItem
 *
 * @property int $id
 * @property int $education_id
 * @property string $name
 * @property mixed $period
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Portfolio\PfEducation $pfEducation
 * @property-read Collection<int, PfEducationItemLocale> $pfEducationItemLocale
 * @property-read int|null $pf_education_item_locale_count
 * @property-read Collection<int, PfEducationItemPlace> $pfEducationItemPlace
 * @property-read int|null $pf_education_item_place_count
 *
 * @method static Builder|PfEducationItem newModelQuery()
 * @method static Builder|PfEducationItem newQuery()
 * @method static Builder|PfEducationItem query()
 * @method static Builder|PfEducationItem whereCreatedAt($value)
 * @method static Builder|PfEducationItem whereEducationId($value)
 * @method static Builder|PfEducationItem whereId($value)
 * @method static Builder|PfEducationItem whereName($value)
 * @method static Builder|PfEducationItem wherePeriod($value)
 * @method static Builder|PfEducationItem whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PfEducationItem extends Model
{
    protected $fillable = [
        'education_id',
        'name',
        'period',
    ];

    protected $casts = [
        'period' => 'array',
    ];

    public function pfEducation(): BelongsTo
    {
        return $this->belongsTo(PfEducation::class, 'education_id', 'id');
    }

    public function pfEducationItemLocale(): HasMany
    {
        return $this->hasMany(PfEducationItemLocale::class, 'education_item_id', 'id');
    }

    public function pfEducationItemPlace(): HasMany
    {
        return $this->hasMany(PfEducationItemPlace::class, 'education_item_id', 'id');
    }
}
