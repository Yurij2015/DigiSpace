<?php

namespace App\Filament\Resources\PfSkillSubcategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PfSkillSubcategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('skill_type_id')
                    ->relationship('skillType', 'skill_type')->searchable()->preload()
                    ->required(),
                TextInput::make('progress'),
                TextInput::make('type')
                    ->required(),
                TextInput::make('fa_icon')
                    ->required(),
                Section::make('EN')->schema([TextInput::make('locales.en.title'), Textarea::make('locales.en.description')]),
                Section::make('UA')->schema([TextInput::make('locales.ua.title'), Textarea::make('locales.ua.description')]),
                Section::make('PL')->schema([TextInput::make('locales.pl.title'), Textarea::make('locales.pl.description')]),
            ]);
    }
}
