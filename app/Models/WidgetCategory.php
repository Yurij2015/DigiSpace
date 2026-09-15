<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 *
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
 *
 * @mixin Eloquent
 */
class WidgetCategory extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    protected $fillable = ['translations'];

    /**
     * Base-language columns that also live under translations.{locale}.
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['name', 'title', 'description'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    public function post(): HasMany
    {
        return $this->hasMany(Widget::class);
    }

    protected function name(): Attribute
    {
        return $this->localizedAttribute('name');
    }

    protected function title(): Attribute
    {
        return $this->localizedAttribute('title');
    }

    protected function description(): Attribute
    {
        return $this->localizedAttribute('description');
    }
}
