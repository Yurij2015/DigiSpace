<?php

namespace App\Filament\Resources\PfSkillLocales;

use App\Filament\Resources\PfSkillLocales\Pages\CreatePfSkillLocale;
use App\Filament\Resources\PfSkillLocales\Pages\EditPfSkillLocale;
use App\Filament\Resources\PfSkillLocales\Pages\ListPfSkillLocales;
use App\Filament\Resources\PfSkillLocales\Schemas\PfSkillLocaleForm;
use App\Filament\Resources\PfSkillLocales\Tables\PfSkillLocalesTable;
use App\Models\Portfolio\PfSkillLocale;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSkillLocaleResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Skill locales';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Portfolio management';
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Skill locales';
    }

    protected static ?string $model = PfSkillLocale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSkillLocaleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSkillLocalesTable::configure($table);
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
            'index' => ListPfSkillLocales::route('/'),
            'create' => CreatePfSkillLocale::route('/create'),
            'edit' => EditPfSkillLocale::route('/{record}/edit'),
        ];
    }
}
