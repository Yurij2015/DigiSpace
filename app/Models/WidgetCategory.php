<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $name
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Widget> $post
 * @property-read int|null $post_count
 * @method static Builder<static>|WidgetCategory newModelQuery()
 * @method static Builder<static>|WidgetCategory newQuery()
 * @method static Builder<static>|WidgetCategory query()
 * @method static Builder<static>|WidgetCategory whereCreatedAt($value)
 * @method static Builder<static>|WidgetCategory whereDescription($value)
 * @method static Builder<static>|WidgetCategory whereId($value)
 * @method static Builder<static>|WidgetCategory whereImage($value)
 * @method static Builder<static>|WidgetCategory whereName($value)
 * @method static Builder<static>|WidgetCategory whereTitle($value)
 * @method static Builder<static>|WidgetCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class WidgetCategory extends Model
{
    public function post(): HasMany
    {
        return $this->hasMany(Widget::class);
    }
}
