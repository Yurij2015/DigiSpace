<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property int $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|FooterUsefulLink newModelQuery()
 * @method static Builder<static>|FooterUsefulLink newQuery()
 * @method static Builder<static>|FooterUsefulLink query()
 * @method static Builder<static>|FooterUsefulLink whereCreatedAt($value)
 * @method static Builder<static>|FooterUsefulLink whereId($value)
 * @method static Builder<static>|FooterUsefulLink whereName($value)
 * @method static Builder<static>|FooterUsefulLink wherePosition($value)
 * @method static Builder<static>|FooterUsefulLink whereStatus($value)
 * @method static Builder<static>|FooterUsefulLink whereUpdatedAt($value)
 * @method static Builder<static>|FooterUsefulLink whereUrl($value)
 * @mixin Eloquent
 */
class FooterUsefulLink extends Model
{
    protected $fillable = [
        'name', 'url', 'status', 'position'
    ];
}
