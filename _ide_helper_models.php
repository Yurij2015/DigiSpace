<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $img_path
 * @property string|null $alt
 * @property string|null $url
 * @property string|null $blog_page_type
 * @property int|null $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Post|null $post
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereBlogPageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPostBanner whereUrl($value)
 */
	class BlogPostBanner extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * @property string|null $slug
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $post
 * @property-read int|null $post_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUserId($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $message
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactForm whereUpdatedAt($value)
 */
	class ContactForm extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $company_name
 * @property string $privacy_policy_title
 * @property string $privacy_policy_href
 * @property string $faq
 * @property string $faq_href
 * @property string $support
 * @property string $support_href
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereFaq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereFaqHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent wherePrivacyPolicyHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent wherePrivacyPolicyTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereSupport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereSupportHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterBottomBarContent whereUpdatedAt($value)
 */
	class FooterBottomBarContent extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterUsefulLink whereUrl($value)
 */
	class FooterUsefulLink extends \Eloquent {}
}

namespace App\Models{
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFirstColHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFirstColHrefContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFirstColName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFirstSocButtonHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFirstSocButtonStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFourthSocButtonHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereFourthSocButtonStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereLoginButtonStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereSecondColHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereSecondColHrefContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereSecondColName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereSecondSocButtonHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereSecondSocButtonStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereThirdSocButtonHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereThirdSocButtonStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeaderNavBarContent whereUpdatedAt($value)
 */
	class HeaderNavBarContent extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $title
 * @property int|null $level 1, 2, 3 ...
 * @property int|null $position 1, 2, 3 ...
 * @property string|null $description
 * @property string|null $location header, footer...
 * @property string $slug
 * @property string $href
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItem> $menuItem
 * @property-read int|null $menu_item_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereUpdatedAt($value)
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $slug
 * @property int $id
 * @property int|null $menu_id
 * @property string|null $name
 * @property string|null $href
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Menu> $menus
 * @property-read int|null $menus_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Page> $pages
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuItem whereUpdatedAt($value)
 */
	class MenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $page_category_id
 * @property string|null $name
 * @property string|null $meta
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $content
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $menu_item_id
 * @property-read \App\Models\MenuItem|null $menuItem
 * @property-read \App\Models\PageCategory|null $pageCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Widget> $widgets
 * @property-read int|null $widgets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereMenuItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page wherePageCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Page> $page
 * @property-read int|null $page_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageCategory whereUpdatedAt($value)
 */
	class PageCategory extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfEducation
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, PfEducationInfoLocale> $pfEducationInfoLocale
 * @property-read int|null $pf_education_info_locale_count
 * @property-read Collection<int, PfEducationItem> $pfEducationItem
 * @property-read int|null $pf_education_item_count
 * @method static Builder|PfEducation newModelQuery()
 * @method static Builder|PfEducation newQuery()
 * @method static Builder|PfEducation query()
 * @method static Builder|PfEducation whereCreatedAt($value)
 * @method static Builder|PfEducation whereId($value)
 * @method static Builder|PfEducation whereName($value)
 * @method static Builder|PfEducation whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfEducation extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfEducationInfoLocale
 *
 * @property int $id
 * @property int $education_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducation $pfEducation
 * @method static Builder|PfEducationInfoLocale newModelQuery()
 * @method static Builder|PfEducationInfoLocale newQuery()
 * @method static Builder|PfEducationInfoLocale query()
 * @method static Builder|PfEducationInfoLocale whereCreatedAt($value)
 * @method static Builder|PfEducationInfoLocale whereDescription($value)
 * @method static Builder|PfEducationInfoLocale whereEducationId($value)
 * @method static Builder|PfEducationInfoLocale whereId($value)
 * @method static Builder|PfEducationInfoLocale whereLocale($value)
 * @method static Builder|PfEducationInfoLocale whereTitle($value)
 * @method static Builder|PfEducationInfoLocale whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfEducationInfoLocale extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfEducationItem
 *
 * @property int $id
 * @property int $education_id
 * @property string $name
 * @property mixed $period
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Portfolio\PfEducation $pfEducation
 * @property-read Collection<int, PfEducationItemLocale> $pfEducationItemLocale
 * @property-read int|null $pf_education_item_locale_count
 * @property-read Collection<int, PfEducationItemPlace> $pfEducationItemPlace
 * @property-read int|null $pf_education_item_place_count
 * @method static Builder|PfEducationItem newModelQuery()
 * @method static Builder|PfEducationItem newQuery()
 * @method static Builder|PfEducationItem query()
 * @method static Builder|PfEducationItem whereCreatedAt($value)
 * @method static Builder|PfEducationItem whereEducationId($value)
 * @method static Builder|PfEducationItem whereId($value)
 * @method static Builder|PfEducationItem whereName($value)
 * @method static Builder|PfEducationItem wherePeriod($value)
 * @method static Builder|PfEducationItem whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfEducationItem extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfEducationItemLocale
 *
 * @property int $id
 * @property int $education_item_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducationItem $pfEducationItem
 * @method static Builder|PfEducationItemLocale newModelQuery()
 * @method static Builder|PfEducationItemLocale newQuery()
 * @method static Builder|PfEducationItemLocale query()
 * @method static Builder|PfEducationItemLocale whereCreatedAt($value)
 * @method static Builder|PfEducationItemLocale whereDescription($value)
 * @method static Builder|PfEducationItemLocale whereEducationItemId($value)
 * @method static Builder|PfEducationItemLocale whereId($value)
 * @method static Builder|PfEducationItemLocale whereLocale($value)
 * @method static Builder|PfEducationItemLocale whereTitle($value)
 * @method static Builder|PfEducationItemLocale whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfEducationItemLocale extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfEducationItemPlace
 *
 * @property int $id
 * @property int $education_item_id
 * @property string $logoUrl
 * @property string $faIcon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducationItem $pfEducationItem
 * @property-read Collection<int, PfEducationItemPlaceLocale> $pfEducationItemPlaceLocale
 * @property-read int|null $pf_education_item_place_locale_count
 * @method static Builder|PfEducationItemPlace newModelQuery()
 * @method static Builder|PfEducationItemPlace newQuery()
 * @method static Builder|PfEducationItemPlace query()
 * @method static Builder|PfEducationItemPlace whereCreatedAt($value)
 * @method static Builder|PfEducationItemPlace whereEducationItemId($value)
 * @method static Builder|PfEducationItemPlace whereFaIcon($value)
 * @method static Builder|PfEducationItemPlace whereId($value)
 * @method static Builder|PfEducationItemPlace whereLogoUrl($value)
 * @method static Builder|PfEducationItemPlace whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfEducationItemPlace extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfEducationItemPlaceLocale
 *
 * @property int $id
 * @property int $education_item_place_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PfEducationItemPlace $pfEducationItemPlace
 * @method static Builder|PfEducationItemPlaceLocale newModelQuery()
 * @method static Builder|PfEducationItemPlaceLocale newQuery()
 * @method static Builder|PfEducationItemPlaceLocale query()
 * @method static Builder|PfEducationItemPlaceLocale whereCreatedAt($value)
 * @method static Builder|PfEducationItemPlaceLocale whereDescription($value)
 * @method static Builder|PfEducationItemPlaceLocale whereEducationItemPlaceId($value)
 * @method static Builder|PfEducationItemPlaceLocale whereId($value)
 * @method static Builder|PfEducationItemPlaceLocale whereLocale($value)
 * @method static Builder|PfEducationItemPlaceLocale whereTitle($value)
 * @method static Builder|PfEducationItemPlaceLocale whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfEducationItemPlaceLocale extends \Eloquent {}
}

namespace App\Models\Portfolio{
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
	class PfLanguage extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\Portfolio\PfLink
 *
 * @property int $id
 * @property int|null $item_id
 * @property string|null $fa_icon
 * @property string|null $href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfLink newModelQuery()
 * @method static Builder|PfLink newQuery()
 * @method static Builder|PfLink query()
 * @method static Builder|PfLink whereCreatedAt($value)
 * @method static Builder|PfLink whereFaIcon($value)
 * @method static Builder|PfLink whereHref($value)
 * @method static Builder|PfLink whereId($value)
 * @method static Builder|PfLink whereItemId($value)
 * @method static Builder|PfLink whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfLink extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\Portfolio\PfLocale
 *
 * @property int $id
 * @property int|null $section_id
 * @property int|null $item_id
 * @property int|null $place_id
 * @property int|null $subcategory_id
 * @property int|null $en_id
 * @property int|null $ua_id
 * @property int|null $pl_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfLocale newModelQuery()
 * @method static Builder|PfLocale newQuery()
 * @method static Builder|PfLocale query()
 * @method static Builder|PfLocale whereCreatedAt($value)
 * @method static Builder|PfLocale whereEnId($value)
 * @method static Builder|PfLocale whereId($value)
 * @method static Builder|PfLocale whereItemId($value)
 * @method static Builder|PfLocale wherePlId($value)
 * @method static Builder|PfLocale wherePlaceId($value)
 * @method static Builder|PfLocale whereSectionId($value)
 * @method static Builder|PfLocale whereSubcategoryId($value)
 * @method static Builder|PfLocale whereUaId($value)
 * @method static Builder|PfLocale whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\Portfolio\PfLanguage|null $en
 * @property-read \App\Models\Portfolio\PfLanguage|null $pl
 * @property-read \App\Models\Portfolio\PfPlace|null $place
 * @property-read \App\Models\Portfolio\PfSection|null $section
 * @property-read \App\Models\Portfolio\PfSectionItem|null $sectionItem
 * @property-read \App\Models\Portfolio\PfSubcategory|null $subcategory
 * @property-read \App\Models\Portfolio\PfLanguage|null $ua
 */
	class PfLocale extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\Portfolio\PfPlace
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $logo_url
 * @property string|null $fa_icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfPlace newModelQuery()
 * @method static Builder|PfPlace newQuery()
 * @method static Builder|PfPlace query()
 * @method static Builder|PfPlace whereCreatedAt($value)
 * @method static Builder|PfPlace whereFaIcon($value)
 * @method static Builder|PfPlace whereId($value)
 * @method static Builder|PfPlace whereLogoUrl($value)
 * @method static Builder|PfPlace whereName($value)
 * @method static Builder|PfPlace whereSlug($value)
 * @method static Builder|PfPlace whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfPlace extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\Portfolio\PfSection
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSection newModelQuery()
 * @method static Builder|PfSection newQuery()
 * @method static Builder|PfSection query()
 * @method static Builder|PfSection whereCreatedAt($value)
 * @method static Builder|PfSection whereDescription($value)
 * @method static Builder|PfSection whereId($value)
 * @method static Builder|PfSection whereName($value)
 * @method static Builder|PfSection whereSlug($value)
 * @method static Builder|PfSection whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfSection extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\Portfolio\PfSectionItem
 *
 * @property int $id
 * @property int|null $section_id
 * @property int|null $subcategory_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $title
 * @property int|null $place_id
 * @property mixed|null $period
 * @property string|null $image_icon_url
 * @property string|null $fa_icon
 * @property string|null $value
 * @property string|null $logo_url
 * @property string|null $href
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSectionItem newModelQuery()
 * @method static Builder|PfSectionItem newQuery()
 * @method static Builder|PfSectionItem query()
 * @method static Builder|PfSectionItem whereCreatedAt($value)
 * @method static Builder|PfSectionItem whereFaIcon($value)
 * @method static Builder|PfSectionItem whereHref($value)
 * @method static Builder|PfSectionItem whereId($value)
 * @method static Builder|PfSectionItem whereImageIconUrl($value)
 * @method static Builder|PfSectionItem whereLogoUrl($value)
 * @method static Builder|PfSectionItem whereName($value)
 * @method static Builder|PfSectionItem wherePeriod($value)
 * @method static Builder|PfSectionItem wherePlaceId($value)
 * @method static Builder|PfSectionItem whereSectionId($value)
 * @method static Builder|PfSectionItem whereSlug($value)
 * @method static Builder|PfSectionItem whereSubcategoryId($value)
 * @method static Builder|PfSectionItem whereTitle($value)
 * @method static Builder|PfSectionItem whereUpdatedAt($value)
 * @method static Builder|PfSectionItem whereValue($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Portfolio\PfLink> $links
 * @property-read int|null $links_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Portfolio\PfLocale> $locales
 * @property-read int|null $locales_count
 * @property-read \App\Models\Portfolio\PfPlace|null $place
 * @property-read \App\Models\Portfolio\PfSection|null $section
 * @property-read \App\Models\Portfolio\PfSubcategory|null $subcategory
 */
	class PfSectionItem extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfSkillLocale
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSkillLocale newModelQuery()
 * @method static Builder|PfSkillLocale newQuery()
 * @method static Builder|PfSkillLocale query()
 * @method static Builder|PfSkillLocale whereCreatedAt($value)
 * @method static Builder|PfSkillLocale whereDescription($value)
 * @method static Builder|PfSkillLocale whereId($value)
 * @method static Builder|PfSkillLocale whereLang($value)
 * @method static Builder|PfSkillLocale whereTitle($value)
 * @method static Builder|PfSkillLocale whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfSkillLocale extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfSkillSubcategory
 *
 * @property int $id
 * @property int $progress
 * @property mixed $locales
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSkillSubcategory newModelQuery()
 * @method static Builder|PfSkillSubcategory newQuery()
 * @method static Builder|PfSkillSubcategory query()
 * @method static Builder|PfSkillSubcategory whereCreatedAt($value)
 * @method static Builder|PfSkillSubcategory whereFaIcon($value)
 * @method static Builder|PfSkillSubcategory whereId($value)
 * @method static Builder|PfSkillSubcategory whereLocales($value)
 * @method static Builder|PfSkillSubcategory whereProgress($value)
 * @method static Builder|PfSkillSubcategory whereType($value)
 * @method static Builder|PfSkillSubcategory whereUpdatedAt($value)
 * @property int $skill_type_id
 * @property string $fa_icon
 * @property-read PfSkillType|null $skill
 * @method static Builder|PfSkillSubcategory whereSkillTypeId($value)
 * @mixin Eloquent
 * @property string $type
 * @property-read \App\Models\Portfolio\PfSkillType $skillType
 */
	class PfSkillSubcategory extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfSkillType
 *
 * @property int $id
 * @property string $skill
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSkillType newModelQuery()
 * @method static Builder|PfSkillType newQuery()
 * @method static Builder|PfSkillType query()
 * @method static Builder|PfSkillType whereCreatedAt($value)
 * @method static Builder|PfSkillType whereId($value)
 * @method static Builder|PfSkillType whereSkill($value)
 * @method static Builder|PfSkillType whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $skill_type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PfSkillType whereSkillType($value)
 */
	class PfSkillType extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\PfSkills
 *
 * @property int $id
 * @property string $value
 * @property mixed $locales
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSkills newModelQuery()
 * @method static Builder|PfSkills newQuery()
 * @method static Builder|PfSkills query()
 * @method static Builder|PfSkills whereCreatedAt($value)
 * @method static Builder|PfSkills whereFaIcon($value)
 * @method static Builder|PfSkills whereId($value)
 * @method static Builder|PfSkills whereImageIconUrl($value)
 * @method static Builder|PfSkills whereLocales($value)
 * @method static Builder|PfSkills whereSkillId($value)
 * @method static Builder|PfSkills whereUpdatedAt($value)
 * @method static Builder|PfSkills whereValue($value)
 * @property int $skill_type_id
 * @property string $image_icon_url
 * @property string $fa_icon
 * @property-read PfSkillType|null $skill
 * @method static Builder|PfSkills whereSkillTypeId($value)
 * @mixin Eloquent
 * @property-read \App\Models\Portfolio\PfSkillType $skillType
 */
	class PfSkills extends \Eloquent {}
}

namespace App\Models\Portfolio{
/**
 * App\Models\Portfolio\PfSubcategory
 *
 * @property int $id
 * @property int|null $section_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $type
 * @property mixed|null $progress
 * @property string|null $fa_icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PfSubcategory newModelQuery()
 * @method static Builder|PfSubcategory newQuery()
 * @method static Builder|PfSubcategory query()
 * @method static Builder|PfSubcategory whereCreatedAt($value)
 * @method static Builder|PfSubcategory whereFaIcon($value)
 * @method static Builder|PfSubcategory whereId($value)
 * @method static Builder|PfSubcategory whereName($value)
 * @method static Builder|PfSubcategory whereProgress($value)
 * @method static Builder|PfSubcategory whereSectionId($value)
 * @method static Builder|PfSubcategory whereSlug($value)
 * @method static Builder|PfSubcategory whereType($value)
 * @method static Builder|PfSubcategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class PfSubcategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $slug
 * @property string $content
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $img_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $user_id
 * @property int|null $menu_item_id
 * @property-read \App\Models\BlogPostBanner|null $blogPostBanner
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereMenuItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUserId($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property float|null $price_value
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePriceValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $service_css_class
 * @property string|null $product_css_class
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereProductCssClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereServiceCssClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductService whereUpdatedAt($value)
 */
	class ProductService extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $details
 * @property float|null $price
 * @property int|null $service_category_id
 * @property string|null $seo_keywords
 * @property string|null $seo_description
 * @property string|null $seo_title
 * @property string|null $image_alt
 * @property string|null $image
 * @property string|null $description
 * @property string|null $slug
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ServiceCategory|null $serviceCategory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereImageAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereServiceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereUpdatedAt($value)
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $seo_keywords
 * @property string|null $seo_description
 * @property string|null $seo_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $service
 * @property-read int|null $service_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereUpdatedAt($value)
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $value
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereUpdatedAt($value)
 */
	class Subscriber extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property int $widget_category_id
 * @property string|null $icon
 * @property string|null $widget_image
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $css_class
 * @property string|null $anchor
 * @property string|null $element_id
 * @property-read \App\Models\WidgetCategory $widgetCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WidgetIcon> $widgetIcon
 * @property-read int|null $widget_icon_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereAnchor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereCssClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereElementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereWidgetCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Widget whereWidgetImage($value)
 */
	class Widget extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Widget> $post
 * @property-read int|null $post_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetCategory whereUpdatedAt($value)
 */
	class WidgetCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $widget_id
 * @property string $icon_class
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $url
 * @property string|null $css_class
 * @property-read \App\Models\Widget $widget
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereCssClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereIconClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WidgetIcon whereWidgetId($value)
 */
	class WidgetIcon extends \Eloquent {}
}

