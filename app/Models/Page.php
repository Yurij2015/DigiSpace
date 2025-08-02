<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
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
class Page extends Model
{
    protected $fillable = [
        'name', 'content', 'meta', 'description', 'slug', 'page_category_id', 'menu_item_id',
    ];

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
            $page->slug = Str::slug($page->name);
        });

        static::creating(static function ($page) {
            $page->slug = Str::slug($page->name);
        });
    }
}
