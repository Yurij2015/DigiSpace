<?php

namespace App\Filament\Resources\WidgetIcons;

use App\Filament\Resources\WidgetIcons\Pages\CreateWidgetIcon;
use App\Filament\Resources\WidgetIcons\Pages\EditWidgetIcon;
use App\Filament\Resources\WidgetIcons\Pages\ListWidgetIcons;
use App\Filament\Resources\WidgetIcons\Schemas\WidgetIconForm;
use App\Filament\Resources\WidgetIcons\Tables\WidgetIconsTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\WidgetIcon;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WidgetIconResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Widget icons';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Settings->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 60;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Widget icons';
    }

    protected static ?string $model = WidgetIcon::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WidgetIconForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WidgetIconsTable::configure($table);
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
            'index' => ListWidgetIcons::route('/'),
            'create' => CreateWidgetIcon::route('/create'),
            'edit' => EditWidgetIcon::route('/{record}/edit'),
        ];
    }
}
