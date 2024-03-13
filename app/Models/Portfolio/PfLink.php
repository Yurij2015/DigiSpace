<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfLink
 *
 * @property int $id
 * @property int|null $item_id
 * @property string|null $fa_icon
 * @property string|null $href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfLink newModelQuery()
 * @method static Builder|PfLink newQuery()
 * @method static Builder|PfLink query()
 * @method static Builder|PfLink whereCreatedAt($value)
 * @method static Builder|PfLink whereFaIcon($value)
 * @method static Builder|PfLink whereHref($value)
 * @method static Builder|PfLink whereId($value)
 * @method static Builder|PfLink whereItemId($value)
 * @method static Builder|PfLink whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PfLink extends Model
{
    protected $fillable = ['item_id', 'fa_icon', 'href'];
}
