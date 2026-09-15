<?php

namespace App\Filament\Resources\BlogPostBanners\Pages;

use App\Filament\Resources\BlogPostBanners\BlogPostBannerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBlogPostBanner extends EditRecord
{
    protected static string $resource = BlogPostBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
