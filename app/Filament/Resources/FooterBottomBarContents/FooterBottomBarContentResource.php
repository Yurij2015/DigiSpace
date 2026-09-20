<?php

namespace App\Filament\Resources\FooterBottomBarContents;

use App\Filament\Resources\FooterBottomBarContents\Pages\CreateFooterBottomBarContent;
use App\Filament\Resources\FooterBottomBarContents\Pages\EditFooterBottomBarContent;
use App\Filament\Resources\FooterBottomBarContents\Pages\ListFooterBottomBarContents;
use App\Filament\Resources\FooterBottomBarContents\Schemas\FooterBottomBarContentForm;
use App\Filament\Resources\FooterBottomBarContents\Tables\FooterBottomBarContentsTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\FooterBottomBarContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterBottomBarContentResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Bottom bar settings';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Settings->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 100;
    }

    public static function getPluralModelLabel(): string
    {
        return static::getNavigationLabel();
    }

    protected static ?string $model = FooterBottomBarContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return FooterBottomBarContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterBottomBarContentsTable::configure($table);
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
            'index' => ListFooterBottomBarContents::route('/'),
            'create' => CreateFooterBottomBarContent::route('/create'),
            'edit' => EditFooterBottomBarContent::route('/{record}/edit'),
        ];
    }
}
