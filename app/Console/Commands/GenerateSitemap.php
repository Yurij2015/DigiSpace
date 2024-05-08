<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    public function handle(): void
    {
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                if ($url->segment(1) === 'blog') {
                    $url->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);
                } else {
                    $url->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_NEVER);
                }
                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
