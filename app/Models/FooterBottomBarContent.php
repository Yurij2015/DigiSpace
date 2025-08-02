<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @mixin Eloquent
 */
class FooterBottomBarContent extends Model
{
    protected $fillable = [
        'company_name',
        'privacy_policy_title',
        'privacy_policy_href',
        'faq',
        'faq_href',
        'support',
        'support_href'
    ];
}
