<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfSkills
 *
 * @property int $id
 * @property string $value
 * @property mixed $locales
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSkills newModelQuery()
 * @method static Builder|PfSkills newQuery()
 * @method static Builder|PfSkills query()
 * @method static Builder|PfSkills whereCreatedAt($value)
 * @method static Builder|PfSkills whereFaIcon($value)
 * @method static Builder|PfSkills whereId($value)
 * @method static Builder|PfSkills whereImageIconUrl($value)
 * @method static Builder|PfSkills whereLocales($value)
 * @method static Builder|PfSkills whereSkillId($value)
 * @method static Builder|PfSkills whereUpdatedAt($value)
 * @method static Builder|PfSkills whereValue($value)
 * @property int $skill_type_id
 * @property string $image_icon_url
 * @property string $fa_icon
 * @property-read PfSkillType|null $skill
 * @method static Builder|PfSkills whereSkillTypeId($value)
 * @mixin Eloquent
 */
class PfSkills extends Model
{
    protected $fillable = ['skill_type_id', 'image_icon_url', 'fa_icon', 'value', 'locales'];

    protected $casts = [
        'locales' => 'array',
    ];

    public function skillType(): BelongsTo
    {
        return $this->belongsTo(PfSkillType::class);
    }
}
