<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('menu_id')
                    ->numeric(),
                TextInput::make('name'),
                TextInput::make('slug'),
                TextInput::make('href'),
            ]);
    }
}
