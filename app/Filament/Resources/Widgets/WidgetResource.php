<?php

namespace App\Filament\Resources\Widgets;

use App\Filament\Resources\Widgets\Pages\CreateWidget;
use App\Filament\Resources\Widgets\Pages\EditWidget;
use App\Filament\Resources\Widgets\Pages\ListWidgets;
use App\Filament\Resources\Widgets\Schemas\WidgetForm;
use App\Filament\Resources\Widgets\Tables\WidgetsTable;
use App\Models\Widget;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WidgetResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Widgets';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Admin Layout Pages';
    }

    public static function getNavigationSort(): ?int
    {
        return 12;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Widgets';
    }

    protected static ?string $model = Widget::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WidgetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WidgetsTable::configure($table);
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
            'index' => ListWidgets::route('/'),
            'create' => CreateWidget::route('/create'),
            'edit' => EditWidget::route('/{record}/edit'),
        ];
    }
}
