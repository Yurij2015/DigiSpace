<?php

namespace App\Filament\Resources\PfSkillTypes;

use App\Filament\Resources\PfSkillTypes\Pages\CreatePfSkillType;
use App\Filament\Resources\PfSkillTypes\Pages\EditPfSkillType;
use App\Filament\Resources\PfSkillTypes\Pages\ListPfSkillTypes;
use App\Filament\Resources\PfSkillTypes\Schemas\PfSkillTypeForm;
use App\Filament\Resources\PfSkillTypes\Tables\PfSkillTypesTable;
use App\Filament\Support\PanelNavigationGroup;
use App\Models\Portfolio\PfSkillType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PfSkillTypeResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Skill types';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Portfolio->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 30;
    }

    public static function getPluralModelLabel(): string
    {
        return 'Skill types';
    }

    protected static ?string $model = PfSkillType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PfSkillTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PfSkillTypesTable::configure($table);
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
            'index' => ListPfSkillTypes::route('/'),
            'create' => CreatePfSkillType::route('/create'),
            'edit' => EditPfSkillType::route('/{record}/edit'),
        ];
    }
}
