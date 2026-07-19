<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfEducationInfoLocale
 *
 * @property int $id
 * @property int $education_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducation $pfEducation
 *
 * @method static Builder|PfEducationInfoLocale newModelQuery()
 * @method static Builder|PfEducationInfoLocale newQuery()
 * @method static Builder|PfEducationInfoLocale query()
 * @method static Builder|PfEducationInfoLocale whereCreatedAt($value)
 * @method static Builder|PfEducationInfoLocale whereDescription($value)
 * @method static Builder|PfEducationInfoLocale whereEducationId($value)
 * @method static Builder|PfEducationInfoLocale whereId($value)
 * @method static Builder|PfEducationInfoLocale whereLocale($value)
 * @method static Builder|PfEducationInfoLocale whereTitle($value)
 * @method static Builder|PfEducationInfoLocale whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PfEducationInfoLocale extends Model
{
    protected $fillable = [
        'education_id',
        'locale',
        'title',
        'description',
    ];

    public function pfEducation(): BelongsTo
    {
        return $this->belongsTo(PfEducation::class, 'education_id', 'id');
    }
}
