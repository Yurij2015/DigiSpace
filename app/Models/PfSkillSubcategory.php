<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfSkillSubcategory
 *
 * @property int $id
 * @property int $progress
 * @property mixed $locales
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSkillSubcategory newModelQuery()
 * @method static Builder|PfSkillSubcategory newQuery()
 * @method static Builder|PfSkillSubcategory query()
 * @method static Builder|PfSkillSubcategory whereCreatedAt($value)
 * @method static Builder|PfSkillSubcategory whereFaIcon($value)
 * @method static Builder|PfSkillSubcategory whereId($value)
 * @method static Builder|PfSkillSubcategory whereLocales($value)
 * @method static Builder|PfSkillSubcategory whereProgress($value)
 * @method static Builder|PfSkillSubcategory whereType($value)
 * @method static Builder|PfSkillSubcategory whereUpdatedAt($value)
 * @property int $skill_type_id
 * @property string $fa_icon
 * @property-read PfSkillType|null $skill
 * @method static Builder|PfSkillSubcategory whereSkillTypeId($value)
 * @mixin Eloquent
 */
class PfSkillSubcategory extends Model
{
    protected $fillable = ['skill_type_id', 'progress', 'type', 'fa_icon', 'locales'];

    protected $casts = [
        'locales' => 'array',
    ];

    public function skillType(): BelongsTo
    {
        return $this->belongsTo(PfSkillType::class);
    }
}
