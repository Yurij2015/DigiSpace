<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $first_col_name
 * @property string $first_col_href
 * @property string $first_col_href_content
 * @property string $second_col_name
 * @property string $second_col_href
 * @property string $second_col_href_content
 * @property string $first_soc_button_style
 * @property string $first_soc_button_href
 * @property string $second_soc_button_style
 * @property string $second_soc_button_href
 * @property string $third_soc_button_style
 * @property string $third_soc_button_href
 * @property string $fourth_soc_button_style
 * @property string $fourth_soc_button_href
 * @property int $login_button_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|HeaderNavBarContent newModelQuery()
 * @method static Builder<static>|HeaderNavBarContent newQuery()
 * @method static Builder<static>|HeaderNavBarContent query()
 * @method static Builder<static>|HeaderNavBarContent whereCreatedAt($value)
 * @method static Builder<static>|HeaderNavBarContent whereFirstColHref($value)
 * @method static Builder<static>|HeaderNavBarContent whereFirstColHrefContent($value)
 * @method static Builder<static>|HeaderNavBarContent whereFirstColName($value)
 * @method static Builder<static>|HeaderNavBarContent whereFirstSocButtonHref($value)
 * @method static Builder<static>|HeaderNavBarContent whereFirstSocButtonStyle($value)
 * @method static Builder<static>|HeaderNavBarContent whereFourthSocButtonHref($value)
 * @method static Builder<static>|HeaderNavBarContent whereFourthSocButtonStyle($value)
 * @method static Builder<static>|HeaderNavBarContent whereId($value)
 * @method static Builder<static>|HeaderNavBarContent whereLoginButtonStatus($value)
 * @method static Builder<static>|HeaderNavBarContent whereSecondColHref($value)
 * @method static Builder<static>|HeaderNavBarContent whereSecondColHrefContent($value)
 * @method static Builder<static>|HeaderNavBarContent whereSecondColName($value)
 * @method static Builder<static>|HeaderNavBarContent whereSecondSocButtonHref($value)
 * @method static Builder<static>|HeaderNavBarContent whereSecondSocButtonStyle($value)
 * @method static Builder<static>|HeaderNavBarContent whereThirdSocButtonHref($value)
 * @method static Builder<static>|HeaderNavBarContent whereThirdSocButtonStyle($value)
 * @method static Builder<static>|HeaderNavBarContent whereUpdatedAt($value)
 * @mixin Eloquent
 */
class HeaderNavBarContent extends Model
{
    protected $fillable = [
        'first_col_name',
        'first_col_href',
        'first_col_href_content',
        'second_col_name',
        'second_col_href',
        'second_col_href_content',
        'first_soc_button_style',
        'first_soc_button_href',
        'second_soc_button_style',
        'second_soc_button_href',
        'third_soc_button_style',
        'third_soc_button_href',
        'fourth_soc_button_style',
        'fourth_soc_button_href',
        'login_button_status'
    ];
}
