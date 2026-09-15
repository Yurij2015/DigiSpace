<?php

namespace App\Filament\Resources\PfSectionItems;

use App\Filament\Resources\PfSectionItems\Pages\CreatePfSectionItem;
use App\Filament\Resources\PfSectionItems\Pages\EditPfSectionItem;
use App\Filament\Resources\PfSectionItems\Pages\ListPfSectionItems;
use App\Filament\Resources\PfSectionItems\Schemas\PfSectionItemForm;
use App\Filament\Resources\PfSectionItems\Tables\PfSectionItemsTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\Portfolio\PfSectionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSectionItemResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Section items';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Portfolio->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 90;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Section items';
    }

    protected static ?string $model = PfSectionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSectionItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSectionItemsTable::configure($table);
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
            'index' => ListPfSectionItems::route('/'),
            'create' => CreatePfSectionItem::route('/create'),
            'edit' => EditPfSectionItem::route('/{record}/edit'),
        ];
    }
}
