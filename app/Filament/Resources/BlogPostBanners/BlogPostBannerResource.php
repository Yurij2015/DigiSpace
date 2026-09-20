<?php

namespace App\Filament\Resources\BlogPostBanners;

use App\Filament\Resources\BlogPostBanners\Pages\CreateBlogPostBanner;
use App\Filament\Resources\BlogPostBanners\Pages\EditBlogPostBanner;
use App\Filament\Resources\BlogPostBanners\Pages\ListBlogPostBanners;
use App\Filament\Resources\BlogPostBanners\Schemas\BlogPostBannerForm;
use App\Filament\Resources\BlogPostBanners\Tables\BlogPostBannersTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\BlogPostBanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BlogPostBannerResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Banners';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Content->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 40;
    }

    public static function getPluralModelLabel(): string
    {
        return static::getNavigationLabel();
    }

    protected static ?string $model = BlogPostBanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return BlogPostBannerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogPostBannersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogPostBanners::route('/'),
            'create' => CreateBlogPostBanner::route('/create'),
            'edit' => EditBlogPostBanner::route('/{record}/edit'),
        ];
    }
}
