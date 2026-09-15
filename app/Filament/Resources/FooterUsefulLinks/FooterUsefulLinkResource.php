<?php

namespace App\Filament\Resources\FooterUsefulLinks;

use App\Filament\Resources\FooterUsefulLinks\Pages\CreateFooterUsefulLink;
use App\Filament\Resources\FooterUsefulLinks\Pages\EditFooterUsefulLink;
use App\Filament\Resources\FooterUsefulLinks\Pages\ListFooterUsefulLinks;
use App\Filament\Resources\FooterUsefulLinks\Schemas\FooterUsefulLinkForm;
use App\Filament\Resources\FooterUsefulLinks\Tables\FooterUsefulLinksTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\FooterUsefulLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterUsefulLinkResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Useful Links';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Settings->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 110;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Useful Links';
    }

    protected static ?string $model = FooterUsefulLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return FooterUsefulLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterUsefulLinksTable::configure($table);
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
            'index' => ListFooterUsefulLinks::route('/'),
            'create' => CreateFooterUsefulLink::route('/create'),
            'edit' => EditFooterUsefulLink::route('/{record}/edit'),
        ];
    }
}
