<?php

namespace App\Filament\Resources\BlogPostBanners\Pages;

use App\Filament\Resources\BlogPostBanners\BlogPostBannerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPostBanner extends CreateRecord
{
    protected static string $resource = BlogPostBannerResource::class;
}
