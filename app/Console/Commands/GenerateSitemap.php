<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Repositories\BlogRepository;
use Carbon\Carbon;
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
            $sitemap->add($this->localizedUrls($routeName));
        }

        foreach (MenuItem::whereHas('pages')->whereNotNull('slug')->with('pages:id,updated_at')->get(['slug', 'id']) as $menuItem) {
            $sitemap->add($this->localizedUrls(
                'pages.page',
                ['slug' => $menuItem->slug],
                lastmod: $menuItem->pages->max('updated_at'),
            ));
        }

        foreach (Post::published()->get(['slug', 'updated_at']) as $post) {
            $sitemap->add($this->localizedUrls(
                'blog.post',
                ['postSlug' => $post->slug],
                Url::CHANGE_FREQUENCY_MONTHLY,
                $post->updated_at,
            ));
        }

        foreach (Category::whereHas('post', fn ($query) => $query->published())->pluck('slug') as $slug) {
            $sitemap->add($this->localizedUrls('blog-category', ['categorySlug' => $slug]));
        }

        foreach ($blogRepository->getGroupedPosts() as $archiveItem) {
            $sitemap->add($this->localizedUrls(
                'blog-archive',
                ['yearMonth' => $archiveItem->year.'-'.$archiveItem->month],
                Url::CHANGE_FREQUENCY_MONTHLY,
                Carbon::create($archiveItem->year, $archiveItem->month)->endOfMonth(),
            ));
        }

        foreach (ServiceCategory::whereNotNull('slug')->pluck('slug') as $slug) {
            $sitemap->add($this->localizedUrls('category-services', ['serviceCategory' => $slug]));
        }

        foreach (Service::where('status', 'active')->with('serviceCategory:id,slug')->get(['slug', 'service_category_id', 'updated_at']) as $service) {
            if ($service->slug === null || $service->serviceCategory?->slug === null) {
                continue;
            }

            $sitemap->add($this->localizedUrls('category-service', [
                'serviceCategory' => $service->serviceCategory->slug,
                'service' => $service->slug,
            ], lastmod: $service->updated_at));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap written to '.public_path('sitemap.xml'));

        return self::SUCCESS;
    }

    /**
     * Each locale gets an entry with the same complete set of alternates.
     *
     * @param  array<string, string>  $parameters
     * @return list<Url>
     */
    private function localizedUrls(
        string $routeName,
        array $parameters = [],
        string $changeFrequency = Url::CHANGE_FREQUENCY_WEEKLY,
        ?\DateTimeInterface $lastmod = null,
    ): array {
        $locales = config('locales.supported', []);
        $defaultLocale = config('locales.default', $locales[0] ?? 'en');

        $alternates = [];
        foreach ($locales as $locale) {
            $alternates[$locale] = route($routeName, ['locale' => $locale] + $parameters);
        }

        $defaultUrl = route($routeName, ['locale' => $defaultLocale] + $parameters);
        $urls = [];

        foreach ($alternates as $localizedUrl) {
            $url = Url::create($localizedUrl)
                ->setPriority(0.8)
                ->setChangeFrequency($changeFrequency);

            if ($lastmod !== null) {
                $url->setLastModificationDate(Carbon::parse($lastmod));
            }

            foreach ($alternates as $locale => $alternateUrl) {
                $url->addAlternate($alternateUrl, $locale);
            }

            $urls[] = $url->addAlternate($defaultUrl, 'x-default');
        }

        return $urls;
    }
}
