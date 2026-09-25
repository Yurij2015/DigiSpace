<?php

namespace App\Models;

use App\Models\Concerns\HasGenerationAttempts;
use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

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
class Post extends Model implements HasTranslatableColumns
{
    use HasGenerationAttempts;
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}; read by the
     * control-panel edit pages so forms are filled from raw values (see FillsRawTranslatableFields).
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['name', 'content', 'description', 'keywords'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'name', 'slug', 'content', 'status', 'description', 'keywords', 'category_id', 'user_id', 'img_path', 'translations',
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

    protected function description(): Attribute
    {
        return $this->localizedAttribute('description');
    }

    protected function keywords(): Attribute
    {
        return $this->localizedAttribute('keywords');
    }

    /**
     * Get the img_path correct path.
     */
    protected function imgPath(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => match (true) {
                ! $value,
                str_starts_with($value, 'http://'),
                str_starts_with($value, 'https://'),
                str_starts_with($value, '/') => $value,
                str_starts_with($value, 'posts/'),
                str_starts_with($value, 'articles/') => Storage::disk('s3')->url($value),
                default => asset($value),
            },
        );
    }

    #[Scope]
    protected function published(Builder $query): Builder
    {
        return $query->where('status', 'published');
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
