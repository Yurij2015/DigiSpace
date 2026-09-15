<?php

namespace App\Filament\Resources\PfPlaces;

use App\Filament\Resources\PfPlaces\Pages\CreatePfPlace;
use App\Filament\Resources\PfPlaces\Pages\EditPfPlace;
use App\Filament\Resources\PfPlaces\Pages\ListPfPlaces;
use App\Filament\Resources\PfPlaces\Schemas\PfPlaceForm;
use App\Filament\Resources\PfPlaces\Tables\PfPlacesTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\Portfolio\PfPlace;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfPlaceResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Places';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Portfolio->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 80;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Places';
    }

    protected static ?string $model = PfPlace::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfPlaceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfPlacesTable::configure($table);
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
            'index' => ListPfPlaces::route('/'),
            'create' => CreatePfPlace::route('/create'),
            'edit' => EditPfPlace::route('/{record}/edit'),
        ];
    }
}
