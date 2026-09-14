<?php

namespace App\Filament\Resources\PfSkillTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PfSkillTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('skill_type')
                    ->required(),
            ]);
    }
}
