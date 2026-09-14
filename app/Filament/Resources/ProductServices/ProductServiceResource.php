<?php

namespace App\Filament\Resources\ProductServices;

use App\Filament\Resources\ProductServices\Pages\CreateProductService;
use App\Filament\Resources\ProductServices\Pages\EditProductService;
use App\Filament\Resources\ProductServices\Pages\ListProductServices;
use App\Filament\Resources\ProductServices\Schemas\ProductServiceForm;
use App\Filament\Resources\ProductServices\Tables\ProductServicesTable;
use App\Models\ProductService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductServiceResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Product service styles';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Admin Layout Pages';
    }

    public static function getNavigationSort(): ?int
    {
        return 16;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Product service styles';
    }

    protected static ?string $model = ProductService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductServicesTable::configure($table);
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
            'index' => ListProductServices::route('/'),
            'create' => CreateProductService::route('/create'),
            'edit' => EditProductService::route('/{record}/edit'),
        ];
    }
}
