<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $slug
 * @property string $content
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $img_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * @property int|null $menu_item_id
 * @property-read BlogPostBanner|null $blogPostBanner
 * @property-read Category $category
 * @property-read User|null $user
 *
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereCategoryId($value)
 * @method static Builder<static>|Post whereContent($value)
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereDeletedAt($value)
 * @method static Builder<static>|Post whereDescription($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereImgPath($value)
 * @method static Builder<static>|Post whereKeywords($value)
 * @method static Builder<static>|Post whereMenuItemId($value)
 * @method static Builder<static>|Post whereName($value)
 * @method static Builder<static>|Post whereSlug($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUserId($value)
 *
 * @mixin Eloquent
 */
class Post extends Model
{
    protected $fillable = [
        'name', 'slug', 'content', 'description', 'category_id', 'user_id', 'img_path',
    ];

    /**
     * Get the img_path correct path.
     */
    protected function imgPath(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => $value,
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blogPostBanner(): HasOne
    {
        return $this->hasOne(BlogPostBanner::class);
    }
}
