<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfPlace
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $logo_url
 * @property string|null $fa_icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfPlace newModelQuery()
 * @method static Builder|PfPlace newQuery()
 * @method static Builder|PfPlace query()
 * @method static Builder|PfPlace whereCreatedAt($value)
 * @method static Builder|PfPlace whereFaIcon($value)
 * @method static Builder|PfPlace whereId($value)
 * @method static Builder|PfPlace whereLogoUrl($value)
 * @method static Builder|PfPlace whereName($value)
 * @method static Builder|PfPlace whereSlug($value)
 * @method static Builder|PfPlace whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PfPlace extends Model
{
    protected $fillable = ['name', 'slug', 'logo_url', 'fa_icon'];
}
