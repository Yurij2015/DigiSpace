<?php

namespace App\Support;

use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

final class SchemaMarkup
{
    /**
     * Build the schema.org JSON-LD graph for the current public page.
     *
     * @param  array{
     *     url: string,
     *     title: string,
     *     description: string,
     *     image: string,
     *     locale: string,
     *     post?: ?Post,
     *     page?: ?Page,
     *     service?: ?Service,
     *     serviceCategory?: ?ServiceCategory,
     *     socials?: array<int, string|null>
     * }  $context
     * @return array<string, mixed>
     */
    public static function graph(array $context): array
    {
        $graph = [
            self::organization($context['socials'] ?? []),
            self::webSite(),
            self::pageNode($context),
        ];

        $breadcrumbs = self::breadcrumbs($context);
        if ($breadcrumbs !== null) {
            $graph[] = $breadcrumbs;
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    /**
     * @param  array<int, string|null>  $sameAs
     * @return array<string, mixed>
     */
    private static function organization(array $sameAs): array
    {
        $sameAs = array_values(array_filter(array_map(
            static fn (?string $url): ?string => $url === null || $url === ''
                ? null
                : (Str::startsWith($url, ['http://', 'https://']) ? $url : 'https://'.$url),
            $sameAs
        )));

        return array_filter([
            '@type' => 'Organization',
            '@id' => self::organizationId(),
            'name' => config('app.name'),
            'url' => config('app.url'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/DigiSpaceLogo2.svg'),
            ],
            'sameAs' => $sameAs ?: null,
        ], static fn ($value) => $value !== null);
    }

    /**
     * @return array<string, mixed>
     */
    private static function webSite(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => self::webSiteId(),
            'url' => config('app.url'),
            'name' => config('app.name'),
            'publisher' => ['@id' => self::organizationId()],
        ];
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    private static function pageNode(array $context): array
    {
        $route = $context['route'] ?? null;

        return match (true) {
            $route === 'blog.post' && ($context['post'] ?? null) instanceof Post => self::blogPosting($context),
            $route === 'category-service' && ($context['service'] ?? null) instanceof Service => self::service($context),
            $route === 'category-services' && ($context['serviceCategory'] ?? null) instanceof ServiceCategory => self::collectionPage($context),
            default => self::webPage($context),
        };
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    private static function blogPosting(array $context): array
    {
        /** @var Post $post */
        $post = $context['post'];

        return array_filter([
            '@type' => 'BlogPosting',
            '@id' => $context['url'].'#article',
            'headline' => Str::limit($post->name ?: $context['title'], 110, ''),
            'description' => Str::limit($post->description ?: $context['description'], 300, ''),
            'image' => $context['image'],
            'datePublished' => $post->created_at?->toIso8601String(),
            'dateModified' => $post->updated_at?->toIso8601String(),
            'inLanguage' => $context['locale'],
            'author' => [
                '@type' => 'Person',
                'name' => $post->user?->name ?: config('app.name'),
            ],
            'publisher' => ['@id' => self::organizationId()],
            'mainEntityOfPage' => $context['url'],
        ], static fn ($value) => $value !== null);
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    private static function service(array $context): array
    {
        /** @var Service $service */
        $service = $context['service'];
        $serviceCategory = $context['serviceCategory'] ?? null;

        return array_filter([
            '@type' => 'Service',
            'name' => $service->title,
            'description' => Str::limit($service->seo_description ?: $context['description'], 300, ''),
            'image' => asset(ltrim($service->image, '/')),
            'url' => $context['url'],
            'serviceType' => $serviceCategory instanceof ServiceCategory ? $serviceCategory->name : null,
            'provider' => ['@id' => self::organizationId()],
        ], static fn ($value) => $value !== null);
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    private static function collectionPage(array $context): array
    {
        /** @var ServiceCategory $serviceCategory */
        $serviceCategory = $context['serviceCategory'];

        return array_filter([
            '@type' => 'CollectionPage',
            'name' => $serviceCategory->seo_title ?: $serviceCategory->name,
            'description' => Str::limit($serviceCategory->seo_description ?: $context['description'], 300, ''),
            'url' => $context['url'],
            'inLanguage' => $context['locale'],
            'isPartOf' => ['@id' => self::webSiteId()],
        ], static fn ($value) => $value !== null);
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>
     */
    private static function webPage(array $context): array
    {
        return [
            '@type' => 'WebPage',
            '@id' => $context['url'],
            'url' => $context['url'],
            'name' => $context['title'],
            'description' => Str::limit($context['description'], 300, ''),
            'inLanguage' => $context['locale'],
            'isPartOf' => ['@id' => self::webSiteId()],
        ];
    }

    /**
     * @param  array<string, mixed>  $context
     * @return array<string, mixed>|null
     */
    private static function breadcrumbs(array $context): ?array
    {
        $route = $context['route'] ?? null;
        $trail = null;

        if ($route === 'blog.post' && ($context['post'] ?? null) instanceof Post) {
            /** @var Post $post */
            $post = $context['post'];
            $trail = [
                ['name' => 'Blog', 'url' => route('blog')],
            ];
            if ($post->category !== null) {
                $trail[] = [
                    'name' => $post->category->name,
                    'url' => route('blog-category', $post->category->slug),
                ];
            }
            $trail[] = ['name' => $post->name, 'url' => $context['url']];
        } elseif ($route === 'category-service' && ($context['service'] ?? null) instanceof Service) {
            /** @var Service $service */
            $service = $context['service'];
            $serviceCategory = $context['serviceCategory'] ?? null;
            $trail = [['name' => __('site.services'), 'url' => route('services')]];
            if ($serviceCategory instanceof ServiceCategory) {
                $trail[] = [
                    'name' => $serviceCategory->name,
                    'url' => route('category-services', $serviceCategory->slug),
                ];
            }
            $trail[] = ['name' => $service->title, 'url' => $context['url']];
        } elseif ($route === 'category-services' && ($context['serviceCategory'] ?? null) instanceof ServiceCategory) {
            /** @var ServiceCategory $serviceCategory */
            $serviceCategory = $context['serviceCategory'];
            $trail = [
                ['name' => __('site.services'), 'url' => route('services')],
                ['name' => $serviceCategory->name, 'url' => $context['url']],
            ];
        } elseif (in_array($route, ['pages.page', 'privacy-policy', 'faq', 'support'], true)
            && ($context['page'] ?? null) instanceof Page) {
            /** @var Page $page */
            $page = $context['page'];
            $trail = [['name' => $page->name, 'url' => $context['url']]];
        }

        if ($trail === null) {
            return null;
        }

        $items = array_merge(
            [['name' => __('site.home'), 'url' => route('home.index')]],
            $trail
        );

        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(
                static fn (array $item, int $index): array => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['name'],
                    'item' => $item['url'],
                ],
                $items,
                array_keys($items)
            ),
        ];
    }

    private static function organizationId(): string
    {
        return rtrim((string) config('app.url'), '/').'/#organization';
    }

    private static function webSiteId(): string
    {
        return rtrim((string) config('app.url'), '/').'/#website';
    }
}
