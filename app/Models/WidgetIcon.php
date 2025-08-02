<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $widget_id
 * @property string $icon_class
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $url
 * @property string|null $css_class
 * @property-read Widget $widget
 * @method static Builder<static>|WidgetIcon newModelQuery()
 * @method static Builder<static>|WidgetIcon newQuery()
 * @method static Builder<static>|WidgetIcon query()
 * @method static Builder<static>|WidgetIcon whereCreatedAt($value)
 * @method static Builder<static>|WidgetIcon whereCssClass($value)
 * @method static Builder<static>|WidgetIcon whereDescription($value)
 * @method static Builder<static>|WidgetIcon whereIconClass($value)
 * @method static Builder<static>|WidgetIcon whereId($value)
 * @method static Builder<static>|WidgetIcon whereUpdatedAt($value)
 * @method static Builder<static>|WidgetIcon whereUrl($value)
 * @method static Builder<static>|WidgetIcon whereWidgetId($value)
 * @mixin Eloquent
 */
class WidgetIcon extends Model
{
    protected $fillable = [
        'icon_class', 'description', 'url', 'css_class'
    ];

    public function widget(): BelongsTo
    {
        return $this->belongsTo(Widget::class);
    }
}
