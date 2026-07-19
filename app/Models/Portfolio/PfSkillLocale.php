<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfSkillLocale
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PfSkillLocale newModelQuery()
 * @method static Builder|PfSkillLocale newQuery()
 * @method static Builder|PfSkillLocale query()
 * @method static Builder|PfSkillLocale whereCreatedAt($value)
 * @method static Builder|PfSkillLocale whereDescription($value)
 * @method static Builder|PfSkillLocale whereId($value)
 * @method static Builder|PfSkillLocale whereLang($value)
 * @method static Builder|PfSkillLocale whereTitle($value)
 * @method static Builder|PfSkillLocale whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PfSkillLocale extends Model
{
    protected $fillable = ['lang', 'title', 'description'];
}
