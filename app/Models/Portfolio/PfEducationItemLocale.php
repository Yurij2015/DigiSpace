<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfEducationItemLocale
 *
 * @property int $id
 * @property int $education_item_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducationItem $pfEducationItem
 *
 * @method static Builder|PfEducationItemLocale newModelQuery()
 * @method static Builder|PfEducationItemLocale newQuery()
 * @method static Builder|PfEducationItemLocale query()
 * @method static Builder|PfEducationItemLocale whereCreatedAt($value)
 * @method static Builder|PfEducationItemLocale whereDescription($value)
 * @method static Builder|PfEducationItemLocale whereEducationItemId($value)
 * @method static Builder|PfEducationItemLocale whereId($value)
 * @method static Builder|PfEducationItemLocale whereLocale($value)
 * @method static Builder|PfEducationItemLocale whereTitle($value)
 * @method static Builder|PfEducationItemLocale whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PfEducationItemLocale extends Model
{
    protected $fillable = [
        'education_item_id',
        'locale',
        'title',
        'description',
    ];

    public function pfEducationItem(): BelongsTo
    {
        return $this->belongsTo(PfEducationItem::class, 'education_item_id', 'id');
    }
}
