<?php

namespace App\Models;

use App\Models\Concerns\HasGenerationAttempts;
use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Str;

/**
 * @property int $id
 * @property int|null $page_category_id
 * @property string|null $name
 * @property string|null $meta
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $content
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $menu_item_id
 * @property-read MenuItem|null $menuItem
 * @property-read PageCategory|null $pageCategory
 * @property-read Collection<int, Widget> $widgets
 * @property-read int|null $widgets_count
 *
 * @method static Builder<static>|Page newModelQuery()
 * @method static Builder<static>|Page newQuery()
 * @method static Builder<static>|Page query()
 * @method static Builder<static>|Page whereContent($value)
 * @method static Builder<static>|Page whereCreatedAt($value)
 * @method static Builder<static>|Page whereDescription($value)
 * @method static Builder<static>|Page whereId($value)
 * @method static Builder<static>|Page whereKeywords($value)
 * @method static Builder<static>|Page whereMenuItemId($value)
 * @method static Builder<static>|Page whereMeta($value)
 * @method static Builder<static>|Page whereName($value)
 * @method static Builder<static>|Page wherePageCategoryId($value)
 * @method static Builder<static>|Page whereSlug($value)
 * @method static Builder<static>|Page whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Page extends Model implements HasTranslatableColumns
{
    use HasGenerationAttempts;
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}; read by the
     * control-panel edit pages so forms are filled from raw values (see FillsRawTranslatableFields).
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['name', 'content', 'meta', 'description', 'keywords'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'name', 'content', 'meta', 'description', 'slug', 'page_category_id', 'menu_item_id', 'translations',
    ];

    protected function casts(): array
    {
        return [];
    }

    protected function name(): Attribute
    {
        return $this->localizedAttribute('name');
    }

    protected function content(): Attribute
    {
        return $this->localizedAttribute('content');
    }

    protected function meta(): Attribute
    {
        return $this->localizedAttribute('meta');
    }

    protected function description(): Attribute
    {
        return $this->localizedAttribute('description');
    }

    protected function keywords(): Attribute
    {
        return $this->localizedAttribute('keywords');
    }

    public function widgets(): BelongsToMany
    {
        return $this->belongsToMany(Widget::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function pageCategory(): BelongsTo
    {
        return $this->belongsTo(PageCategory::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::updating(static function ($page) {
            $page->slug = Str::slug((string) ($page->getAttributes()['name'] ?? $page->getRawOriginal('name')));
        });

        static::creating(static function ($page) {
            $page->slug = Str::slug((string) ($page->getRawOriginal('name') ?: $page->name));
        });
    }
}
