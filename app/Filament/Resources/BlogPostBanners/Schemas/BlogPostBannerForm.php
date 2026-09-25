<?php

namespace App\Filament\Resources\BlogPostBanners\Schemas;

use App\Filament\Support\ContentImage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BlogPostBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ContentImage::make('img_path', 's3', 'banners')
                    ->required(),
                TextInput::make('alt'),
                TextInput::make('url')
                    ->url(),
                TextInput::make('blog_page_type'),
                Select::make('post_id')
                    ->relationship('post', 'name'),
            ]);
    }
}
