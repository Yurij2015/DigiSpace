<?php

namespace App\Filament\Resources\HeaderNavBarContents;

use App\Filament\Resources\HeaderNavBarContents\Pages\CreateHeaderNavBarContent;
use App\Filament\Resources\HeaderNavBarContents\Pages\EditHeaderNavBarContent;
use App\Filament\Resources\HeaderNavBarContents\Pages\ListHeaderNavBarContents;
use App\Filament\Resources\HeaderNavBarContents\Schemas\HeaderNavBarContentForm;
use App\Filament\Resources\HeaderNavBarContents\Tables\HeaderNavBarContentsTable;
use App\Models\HeaderNavBarContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HeaderNavBarContentResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Top bar settings';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Header';
    }

    public static function getNavigationSort(): ?int
    {
        return 18;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Top bar settings';
    }

    protected static ?string $model = HeaderNavBarContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HeaderNavBarContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HeaderNavBarContentsTable::configure($table);
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
            'index' => ListHeaderNavBarContents::route('/'),
            'create' => CreateHeaderNavBarContent::route('/create'),
            'edit' => EditHeaderNavBarContent::route('/{record}/edit'),
        ];
    }
}
