<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
class Widget extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}.
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['title', 'subtitle', 'content'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'translations',
        'title', 'content', 'subtitle', 'widget_category_id', 'icon', 'widget_image', 'css_class', 'anchor', 'element_id',
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
            get: static fn ($value) => match (true) {
                ! $value => Storage::disk('s3')->url('widgets/no_image.png'),
                str_starts_with($value, 'http://'),
                str_starts_with($value, 'https://') => $value,
                default => Storage::disk('s3')->url($value),
            },
        );
    }

    public function widgetIcon(): HasMany
    {
        return $this->hasMany(WidgetIcon::class);
    }

    protected function title(): Attribute
    {
        return $this->localizedAttribute('title');
    }

    protected function subtitle(): Attribute
    {
        return $this->localizedAttribute('subtitle');
    }

    protected function content(): Attribute
    {
        return $this->localizedAttribute('content');
    }

    /**
     * Stable key templates use to pick a widget for a layout slot (the footer's phone /
     * subscribe / about / latest-news / useful-links blocks). element_id when set, else the
     * base-language title as a slug so un-keyed rows from older databases keep matching.
     */
    protected function slot(): Attribute
    {
        return Attribute::make(
            get: fn (): string => filled($this->getRawOriginal('element_id'))
                ? (string) $this->getRawOriginal('element_id')
                : Str::slug((string) $this->getRawOriginal('title')),
        );
    }
}
