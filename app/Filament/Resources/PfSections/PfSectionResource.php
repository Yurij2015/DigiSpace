<?php

namespace App\Filament\Resources\PfSections;

use App\Filament\Resources\PfSections\Pages\CreatePfSection;
use App\Filament\Resources\PfSections\Pages\EditPfSection;
use App\Filament\Resources\PfSections\Pages\ListPfSections;
use App\Filament\Resources\PfSections\Schemas\PfSectionForm;
use App\Filament\Resources\PfSections\Tables\PfSectionsTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\Portfolio\PfSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSectionResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Section Management';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Portfolio->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 60;
    }

    public static function getPluralModelLabel(): string
    {
        return static::getNavigationLabel();
    }

    protected static ?string $model = PfSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSectionsTable::configure($table);
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
            'index' => ListPfSections::route('/'),
            'create' => CreatePfSection::route('/create'),
            'edit' => EditPfSection::route('/{record}/edit'),
        ];
    }
}
