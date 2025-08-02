<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $img_path
 * @property string|null $alt
 * @property string|null $url
 * @property string|null $blog_page_type
 * @property int|null $post_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Post|null $post
 *
 * @method static Builder<static>|BlogPostBanner newModelQuery()
 * @method static Builder<static>|BlogPostBanner newQuery()
 * @method static Builder<static>|BlogPostBanner query()
 * @method static Builder<static>|BlogPostBanner whereAlt($value)
 * @method static Builder<static>|BlogPostBanner whereBlogPageType($value)
 * @method static Builder<static>|BlogPostBanner whereCreatedAt($value)
 * @method static Builder<static>|BlogPostBanner whereId($value)
 * @method static Builder<static>|BlogPostBanner whereImgPath($value)
 * @method static Builder<static>|BlogPostBanner wherePostId($value)
 * @method static Builder<static>|BlogPostBanner whereUpdatedAt($value)
 * @method static Builder<static>|BlogPostBanner whereUrl($value)
 *
 * @mixin Eloquent
 */
class BlogPostBanner extends Model
{
    protected $fillable = [
        'img_path', 'blog_page_type', 'post_id', 'alt', 'url',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
