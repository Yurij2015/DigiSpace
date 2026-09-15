<?php

namespace App\Filament\Resources\PfSubcategories;

use App\Filament\Resources\PfSubcategories\Pages\CreatePfSubcategory;
use App\Filament\Resources\PfSubcategories\Pages\EditPfSubcategory;
use App\Filament\Resources\PfSubcategories\Pages\ListPfSubcategories;
use App\Filament\Resources\PfSubcategories\Schemas\PfSubcategoryForm;
use App\Filament\Resources\PfSubcategories\Tables\PfSubcategoriesTable;
use App\Models\Portfolio\PfSubcategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSubcategoryResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Section subcategories';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio management';
    }

    public static function getNavigationSort(): ?int
    {
        return 7;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Section subcategories';
    }

    protected static ?string $model = PfSubcategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSubcategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSubcategoriesTable::configure($table);
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
            'index' => ListPfSubcategories::route('/'),
            'create' => CreatePfSubcategory::route('/create'),
            'edit' => EditPfSubcategory::route('/{record}/edit'),
        ];
    }
}
