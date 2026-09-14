<?php

namespace App\Filament\Resources\PfSkills;

use App\Filament\Resources\PfSkills\Pages\CreatePfSkills;
use App\Filament\Resources\PfSkills\Pages\EditPfSkills;
use App\Filament\Resources\PfSkills\Pages\ListPfSkills;
use App\Filament\Resources\PfSkills\Schemas\PfSkillsForm;
use App\Filament\Resources\PfSkills\Tables\PfSkillsTable;
use App\Models\Portfolio\PfSkills;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSkillsResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Skills';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio management';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Skills';
    }

    protected static ?string $model = PfSkills::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSkillsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSkillsTable::configure($table);
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
            'index' => ListPfSkills::route('/'),
            'create' => CreatePfSkills::route('/create'),
            'edit' => EditPfSkills::route('/{record}/edit'),
        ];
    }
}
