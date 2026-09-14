<?php

namespace App\Filament\Resources\WidgetIcons\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WidgetIconForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('widget_id')
                    ->relationship('widget', 'title')
                    ->required(),
                TextInput::make('icon_class')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                TextInput::make('url')
                    ->url(),
                TextInput::make('css_class'),
            ]);
    }
}
