<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $email
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|Subscriber newModelQuery()
 * @method static Builder<static>|Subscriber newQuery()
 * @method static Builder<static>|Subscriber query()
 * @method static Builder<static>|Subscriber whereCreatedAt($value)
 * @method static Builder<static>|Subscriber whereEmail($value)
 * @method static Builder<static>|Subscriber whereId($value)
 * @method static Builder<static>|Subscriber whereStatus($value)
 * @method static Builder<static>|Subscriber whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Subscriber extends Model
{
    protected $fillable = ['email', 'status'];
}
