<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedContent;
use App\Models\Concerns\HasTranslatableColumns;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property int $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|FooterUsefulLink newModelQuery()
 * @method static Builder<static>|FooterUsefulLink newQuery()
 * @method static Builder<static>|FooterUsefulLink query()
 * @method static Builder<static>|FooterUsefulLink whereCreatedAt($value)
 * @method static Builder<static>|FooterUsefulLink whereId($value)
 * @method static Builder<static>|FooterUsefulLink whereName($value)
 * @method static Builder<static>|FooterUsefulLink wherePosition($value)
 * @method static Builder<static>|FooterUsefulLink whereStatus($value)
 * @method static Builder<static>|FooterUsefulLink whereUpdatedAt($value)
 * @method static Builder<static>|FooterUsefulLink whereUrl($value)
 *
 * @mixin Eloquent
 */
class FooterUsefulLink extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}.
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['name'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'translations',
        'name', 'url', 'status', 'position',
    ];

    protected function name(): Attribute
    {
        return $this->localizedAttribute('name');
    }
}
