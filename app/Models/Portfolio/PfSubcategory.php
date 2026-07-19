<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfSubcategory
 *
 * @property int $id
 * @property int|null $section_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $type
 * @property mixed|null $progress
 * @property string|null $fa_icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PfSubcategory newModelQuery()
 * @method static Builder|PfSubcategory newQuery()
 * @method static Builder|PfSubcategory query()
 * @method static Builder|PfSubcategory whereCreatedAt($value)
 * @method static Builder|PfSubcategory whereFaIcon($value)
 * @method static Builder|PfSubcategory whereId($value)
 * @method static Builder|PfSubcategory whereName($value)
 * @method static Builder|PfSubcategory whereProgress($value)
 * @method static Builder|PfSubcategory whereSectionId($value)
 * @method static Builder|PfSubcategory whereSlug($value)
 * @method static Builder|PfSubcategory whereType($value)
 * @method static Builder|PfSubcategory whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PfSubcategory extends Model
{
    protected $fillable = ['section_id', 'name', 'slug', 'type', 'progress', 'fa_icon'];

    protected $casts = [
        'progress' => 'array',
    ];
}
