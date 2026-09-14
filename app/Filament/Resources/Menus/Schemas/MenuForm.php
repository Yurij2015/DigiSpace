<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('menuItem')->label('Submenu items')->relationship()->schema([
                    TextInput::make('name')->required(), TextInput::make('slug'), TextInput::make('href'),
                ])->columnSpanFull(),
                TextInput::make('name'),
                TextInput::make('title'),
                TextInput::make('level')
                    ->numeric(),
                TextInput::make('position')
                    ->numeric(),
                TextInput::make('description'),
                TextInput::make('location'),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('href')
                    ->required(),
            ]);
    }
}
