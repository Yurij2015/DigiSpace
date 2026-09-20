<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Repositories\BlogRepository;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    private const STATIC_ROUTES = [
        'home.index', 'about', 'services', 'pricing', 'promos', 'blog',
        'contact-us', 'privacy-policy', 'faq', 'support',
    ];

    public function handle(BlogRepository $blogRepository): int
    {
        $sitemap = Sitemap::create();

        foreach (self::STATIC_ROUTES as $routeName) {
            $sitemap->add($this->localizedUrl($routeName));
        }

        foreach (MenuItem::whereHas('pages')->whereNotNull('slug')->pluck('slug') as $slug) {
            $sitemap->add($this->localizedUrl('pages.page', ['slug' => $slug]));
        }

        foreach (Post::where('status', 'published')->pluck('slug') as $slug) {
            $sitemap->add($this->localizedUrl('blog.post', ['postSlug' => $slug], Url::CHANGE_FREQUENCY_MONTHLY));
        }

        foreach (Category::whereHas('post', fn ($query) => $query->where('status', 'published'))->pluck('slug') as $slug) {
            $sitemap->add($this->localizedUrl('blog-category', ['categorySlug' => $slug]));
        }

        foreach ($blogRepository->getGroupedPosts() as $archiveItem) {
            $sitemap->add($this->localizedUrl(
                'blog-archive',
                ['yearMonth' => $archiveItem->year.'-'.$archiveItem->month],
                Url::CHANGE_FREQUENCY_MONTHLY,
            ));
        }

        foreach (ServiceCategory::whereNotNull('slug')->pluck('slug') as $slug) {
            $sitemap->add($this->localizedUrl('category-services', ['serviceCategory' => $slug]));
        }

        foreach (Service::where('status', 'active')->with('serviceCategory:id,slug')->get(['slug', 'service_category_id']) as $service) {
            if ($service->slug === null || $service->serviceCategory?->slug === null) {
                continue;
            }

            $sitemap->add($this->localizedUrl('category-service', [
                'serviceCategory' => $service->serviceCategory->slug,
                'service' => $service->slug,
            ]));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap written to '.public_path('sitemap.xml'));

        return self::SUCCESS;
    }

    /**
     * A localized sitemap entry: <loc> is the default-locale URL, every
     * supported locale (plus x-default) is listed as an alternate.
     *
     * @param  array<string, string>  $parameters
     */
    private function localizedUrl(string $routeName, array $parameters = [], string $changeFrequency = Url::CHANGE_FREQUENCY_NEVER): Url
    {
        $locales = config('locales.supported', []);
        $defaultLocale = config('locales.default', $locales[0] ?? 'en');

        $url = Url::create(route($routeName, ['locale' => $defaultLocale] + $parameters))
            ->setPriority(0.8)
            ->setChangeFrequency($changeFrequency);

        foreach ($locales as $locale) {
            $url->addAlternate(route($routeName, ['locale' => $locale] + $parameters), $locale);
        }

        return $url->addAlternate(route($routeName, ['locale' => $defaultLocale] + $parameters), 'x-default');
    }
}
