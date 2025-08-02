<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property int $widget_category_id
 * @property string|null $icon
 * @property string|null $widget_image
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $css_class
 * @property string|null $anchor
 * @property string|null $element_id
 * @property-read WidgetCategory $widgetCategory
 * @property-read Collection<int, WidgetIcon> $widgetIcon
 * @property-read int|null $widget_icon_count
 *
 * @method static Builder<static>|Widget newModelQuery()
 * @method static Builder<static>|Widget newQuery()
 * @method static Builder<static>|Widget query()
 * @method static Builder<static>|Widget whereAnchor($value)
 * @method static Builder<static>|Widget whereContent($value)
 * @method static Builder<static>|Widget whereCreatedAt($value)
 * @method static Builder<static>|Widget whereCssClass($value)
 * @method static Builder<static>|Widget whereElementId($value)
 * @method static Builder<static>|Widget whereIcon($value)
 * @method static Builder<static>|Widget whereId($value)
 * @method static Builder<static>|Widget whereSubtitle($value)
 * @method static Builder<static>|Widget whereTitle($value)
 * @method static Builder<static>|Widget whereUpdatedAt($value)
 * @method static Builder<static>|Widget whereWidgetCategoryId($value)
 * @method static Builder<static>|Widget whereWidgetImage($value)
 *
 * @mixin Eloquent
 */
class Widget extends Model
{
    protected $fillable = [
        'title', 'content', 'subtitle', 'widget_category_id', 'icon', 'widget_image',
    ];

    public function widgetCategory(): BelongsTo
    {
        return $this->belongsTo(WidgetCategory::class);
    }

    /**
     * Get the img_path correct path.
     */
    protected function widgetImage(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => url('uploads/widgets/'.$value),
        );
    }

    public function widgetIcon(): HasMany
    {
        return $this->hasMany(WidgetIcon::class);
    }
}
