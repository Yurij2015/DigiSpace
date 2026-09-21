<?php

namespace App\Support;

use App\Models\HeaderNavBarContent;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

/**
 * Resolves the SEO head payload (meta description, Open Graph/Twitter values, JSON-LD)
 * for the current public page from the variables controllers pass to the layout.
 */
final class SeoMeta
{
    /**
     * @param  array{
     *     post?: ?Post,
     *     page?: ?Page,
     *     service?: ?Service,
     *     serviceCategory?: ?ServiceCategory,
     *     pageImage?: ?string,
     *     headerNavBarContent?: ?HeaderNavBarContent,
     * }  $view
     * @return array{
     *     seoPost: ?Post,
     *     seoPage: ?Page,
     *     seoService: ?Service,
     *     seoCategory: ?ServiceCategory,
     *     metaDescription: string,
     *     ogTitle: string,
     *     ogImage: string,
     *     jsonLd: array<string, mixed>,
     * }
     */
    public static function resolve(array $view, ?string $route, string $fallbackTitle): array
    {
        $post = $route === 'blog.post' && ($view['post'] ?? null) instanceof Post ? $view['post'] : null;
        $pageRoutes = ['pages.page', 'privacy-policy', 'faq', 'support', 'about', 'services', 'pricing', 'contact-us'];
        $page = null;
        if (in_array($route, $pageRoutes, true)) {
            $page = ($view['page'] ?? null) instanceof Page
                ? $view['page']
                : Page::where('slug', $route)->first();
        }
        $service = $route === 'category-service' && ($view['service'] ?? null) instanceof Service ? $view['service'] : null;
        $category = in_array($route, ['category-service', 'category-services'], true)
            && ($view['serviceCategory'] ?? null) instanceof ServiceCategory ? $view['serviceCategory'] : null;

        $description = match (true) {
            $post !== null => $post->description,
            $page !== null => $page->description,
            $service !== null => $service->seo_description,
            $category !== null => $category->seo_description,
            default => null,
        } ?: match ($route) {
            'blog', 'blog-category', 'blog-archive', 'blog-search' => __('site.meta_description_blog'),
            default => __('site.meta_description'),
        };

        $title = match (true) {
            $post !== null => $post->name,
            $page !== null => $page->name,
            $service !== null => $service->seo_title ?: $service->title,
            $category !== null => $category->seo_title ?: $category->name,
            default => null,
        } ?: $fallbackTitle;

        $image = self::ogImage($post, $page, $service, $view['pageImage'] ?? null);

        $nav = $view['headerNavBarContent'] ?? null;

        return [
            'seoPost' => $post,
            'seoPage' => $page,
            'seoService' => $service,
            'seoCategory' => $category,
            'metaDescription' => $description,
            'ogTitle' => $title,
            'ogImage' => $image,
            'jsonLd' => SchemaMarkup::graph([
                'route' => $route,
                'url' => url()->current(),
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'locale' => app()->getLocale(),
                'post' => $post,
                'page' => $page,
                'service' => $service,
                'serviceCategory' => $category,
                'socials' => $nav instanceof HeaderNavBarContent ? [
                    $nav->first_soc_button_href,
                    $nav->second_soc_button_href,
                    $nav->third_soc_button_href,
                    $nav->fourth_soc_button_href,
                ] : [],
            ]),
        ];
    }

    private static function ogImage(?Post $post, ?Page $page, ?Service $service, mixed $pageImage): string
    {
        $pageImageUrl = null;
        if ($page !== null && filled($pageImage)) {
            $pageImage = (string) $pageImage;
            $pageImageUrl = match (true) {
                Str::startsWith($pageImage, ['http://', 'https://']) => $pageImage,
                Str::startsWith($pageImage, '//') => request()->getScheme().':'.$pageImage,
                Str::startsWith($pageImage, ['/', 'uploads/']) => asset($pageImage),
                default => asset('uploads/widgets/'.$pageImage),
            };
        }

        return match (true) {
            $post !== null => $post->img_path ? asset($post->img_path) : null,
            $page !== null => $pageImageUrl,
            $service !== null => asset($service->image),
            default => null,
        } ?: asset('images/bg-3-1920x480.jpg');
    }
}
