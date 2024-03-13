<?php

namespace App\Models\Portfolio;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio\PfLanguage
 *
 * @property int $id
 * @property string|null $lang_code
 * @property string|null $title
 * @property string|null $description
 * @property string|null $subtitle
 * @property string|null $subtitle_description
 * @property mixed|null $tags
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfLanguage newModelQuery()
 * @method static Builder|PfLanguage newQuery()
 * @method static Builder|PfLanguage query()
 * @method static Builder|PfLanguage whereCreatedAt($value)
 * @method static Builder|PfLanguage whereDescription($value)
 * @method static Builder|PfLanguage whereId($value)
 * @method static Builder|PfLanguage whereLangCode($value)
 * @method static Builder|PfLanguage whereSubtitle($value)
 * @method static Builder|PfLanguage whereSubtitleDescription($value)
 * @method static Builder|PfLanguage whereTags($value)
 * @method static Builder|PfLanguage whereTitle($value)
 * @method static Builder|PfLanguage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PfLanguage extends Model
{
    protected $fillable = ['lang_code', 'title', 'description', 'subtitle', 'subtitle_description', 'tags'];

    protected $casts = [
        'tags' => 'array',
    ];
}
