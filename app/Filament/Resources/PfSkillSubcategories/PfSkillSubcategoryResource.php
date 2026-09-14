<?php

namespace App\Filament\Resources\PfSkillSubcategories;

use App\Filament\Resources\PfSkillSubcategories\Pages\CreatePfSkillSubcategory;
use App\Filament\Resources\PfSkillSubcategories\Pages\EditPfSkillSubcategory;
use App\Filament\Resources\PfSkillSubcategories\Pages\ListPfSkillSubcategories;
use App\Filament\Resources\PfSkillSubcategories\Schemas\PfSkillSubcategoryForm;
use App\Filament\Resources\PfSkillSubcategories\Tables\PfSkillSubcategoriesTable;
use App\Models\Portfolio\PfSkillSubcategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSkillSubcategoryResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Skill subcategories';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio management';
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Skill subcategories';
    }

    protected static ?string $model = PfSkillSubcategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSkillSubcategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSkillSubcategoriesTable::configure($table);
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
            'index' => ListPfSkillSubcategories::route('/'),
            'create' => CreatePfSkillSubcategory::route('/create'),
            'edit' => EditPfSkillSubcategory::route('/{record}/edit'),
        ];
    }
}
