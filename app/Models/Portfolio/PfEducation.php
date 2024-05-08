<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfEducation
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, PfEducationInfoLocale> $pfEducationInfoLocale
 * @property-read int|null $pf_education_info_locale_count
 * @property-read Collection<int, PfEducationItem> $pfEducationItem
 * @property-read int|null $pf_education_item_count
 * @method static Builder|PfEducation newModelQuery()
 * @method static Builder|PfEducation newQuery()
 * @method static Builder|PfEducation query()
 * @method static Builder|PfEducation whereCreatedAt($value)
 * @method static Builder|PfEducation whereId($value)
 * @method static Builder|PfEducation whereName($value)
 * @method static Builder|PfEducation whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PfEducation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function pfEducationInfoLocale(): HasMany
    {
        return $this->hasMany(PfEducationInfoLocale::class, 'education_id', 'id');
    }

    public function pfEducationItem(): HasMany
    {
        return $this->hasMany(PfEducationItem::class, 'education_id', 'id');
    }
}
