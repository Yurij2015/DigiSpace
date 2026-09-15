<?php

namespace App\Filament\Resources\BlogPostBanners\Pages;

use App\Filament\Resources\BlogPostBanners\BlogPostBannerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBlogPostBanners extends ListRecords
{
    protected static string $resource = BlogPostBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
