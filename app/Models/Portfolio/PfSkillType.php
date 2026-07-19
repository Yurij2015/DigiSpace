<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfSkillType
 *
 * @property int $id
 * @property string $skill
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PfSkillType newModelQuery()
 * @method static Builder|PfSkillType newQuery()
 * @method static Builder|PfSkillType query()
 * @method static Builder|PfSkillType whereCreatedAt($value)
 * @method static Builder|PfSkillType whereId($value)
 * @method static Builder|PfSkillType whereSkill($value)
 * @method static Builder|PfSkillType whereUpdatedAt($value)
 *
 * @property string $skill_type
 *
 * @method static Builder<static>|PfSkillType whereSkillType($value)
 *
 * @mixin Eloquent
 */
class PfSkillType extends Model
{
    protected $fillable = ['skill_type'];
}
