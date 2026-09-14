<?php

namespace App\Filament\Widgets;

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ControlOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pages', Page::count())
                ->description('Manage site pages')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->url(route('filament.control.resources.pages.index')),
            Stat::make('Posts', Post::count())
                ->description('Manage blog posts')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('warning')
                ->url(route('filament.control.resources.posts.index')),
            Stat::make('Services', Service::count())
                ->description('Open legacy service manager')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success')
                ->url(route('filament.control.resources.services.index')),
            Stat::make('Products', Product::count())
                ->description('Open legacy product manager')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info')
                ->url(route('filament.control.resources.products.index')),
        ];
    }
}
