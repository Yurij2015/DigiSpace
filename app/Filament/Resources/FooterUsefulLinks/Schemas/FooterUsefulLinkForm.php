<?php

namespace App\Filament\Resources\FooterUsefulLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FooterUsefulLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('url')
                    ->url()
                    ->required(),
                Toggle::make('status')
                    ->required(),
                TextInput::make('position')
                    ->required()
                    ->numeric(),
            ]);
    }
}
