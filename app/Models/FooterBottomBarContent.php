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
 * @property string $company_name
 * @property string $privacy_policy_title
 * @property string $privacy_policy_href
 * @property string $faq
 * @property string $faq_href
 * @property string $support
 * @property string $support_href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|FooterBottomBarContent newModelQuery()
 * @method static Builder<static>|FooterBottomBarContent newQuery()
 * @method static Builder<static>|FooterBottomBarContent query()
 * @method static Builder<static>|FooterBottomBarContent whereCompanyName($value)
 * @method static Builder<static>|FooterBottomBarContent whereCreatedAt($value)
 * @method static Builder<static>|FooterBottomBarContent whereFaq($value)
 * @method static Builder<static>|FooterBottomBarContent whereFaqHref($value)
 * @method static Builder<static>|FooterBottomBarContent whereId($value)
 * @method static Builder<static>|FooterBottomBarContent wherePrivacyPolicyHref($value)
 * @method static Builder<static>|FooterBottomBarContent wherePrivacyPolicyTitle($value)
 * @method static Builder<static>|FooterBottomBarContent whereSupport($value)
 * @method static Builder<static>|FooterBottomBarContent whereSupportHref($value)
 * @method static Builder<static>|FooterBottomBarContent whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class FooterBottomBarContent extends Model implements HasTranslatableColumns
{
    use HasLocalizedContent;

    /**
     * Base-language columns that also live under translations.{locale}.
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['privacy_policy_title', 'faq', 'support'];

    public static function translatableColumns(): array
    {
        return self::TRANSLATABLE;
    }

    protected $fillable = [
        'translations',
        'company_name',
        'privacy_policy_title',
        'privacy_policy_href',
        'faq',
        'faq_href',
        'support',
        'support_href',
    ];

    protected function privacyPolicyTitle(): Attribute
    {
        return $this->localizedAttribute('privacy_policy_title');
    }

    protected function faq(): Attribute
    {
        return $this->localizedAttribute('faq');
    }

    protected function support(): Attribute
    {
        return $this->localizedAttribute('support');
    }
}
