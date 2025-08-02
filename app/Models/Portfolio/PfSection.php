<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfSection
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PfSection newModelQuery()
 * @method static Builder|PfSection newQuery()
 * @method static Builder|PfSection query()
 * @method static Builder|PfSection whereCreatedAt($value)
 * @method static Builder|PfSection whereDescription($value)
 * @method static Builder|PfSection whereId($value)
 * @method static Builder|PfSection whereName($value)
 * @method static Builder|PfSection whereSlug($value)
 * @method static Builder|PfSection whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PfSection extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];
}
