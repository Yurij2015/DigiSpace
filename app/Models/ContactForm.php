<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $message
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|ContactForm newModelQuery()
 * @method static Builder<static>|ContactForm newQuery()
 * @method static Builder<static>|ContactForm query()
 * @method static Builder<static>|ContactForm whereCreatedAt($value)
 * @method static Builder<static>|ContactForm whereEmail($value)
 * @method static Builder<static>|ContactForm whereId($value)
 * @method static Builder<static>|ContactForm whereMessage($value)
 * @method static Builder<static>|ContactForm whereName($value)
 * @method static Builder<static>|ContactForm wherePhone($value)
 * @method static Builder<static>|ContactForm whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class ContactForm extends Model
{
    protected $fillable = ['first_name', 'last_name', 'name', 'email', 'phone', 'message'];
}
