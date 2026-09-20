<?php

namespace App\Filament\Resources\PfEducationItems;

use App\Filament\Resources\PfEducationItems\Pages\CreatePfEducationItem;
use App\Filament\Resources\PfEducationItems\Pages\EditPfEducationItem;
use App\Filament\Resources\PfEducationItems\Pages\ListPfEducationItems;
use App\Filament\Resources\PfEducationItems\Schemas\PfEducationItemForm;
use App\Filament\Resources\PfEducationItems\Tables\PfEducationItemsTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\Portfolio\PfEducationItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfEducationItemResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Education';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Portfolio->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function getPluralModelLabel(): string
    {
        return static::getNavigationLabel();
    }

    protected static ?string $model = PfEducationItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfEducationItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfEducationItemsTable::configure($table);
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
            'index' => ListPfEducationItems::route('/'),
            'create' => CreatePfEducationItem::route('/create'),
            'edit' => EditPfEducationItem::route('/{record}/edit'),
        ];
    }
}
