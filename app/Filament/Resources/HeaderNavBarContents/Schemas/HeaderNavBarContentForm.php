<?php

namespace App\Filament\Resources\HeaderNavBarContents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeaderNavBarContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_col_name')
                    ->required(),
                TextInput::make('first_col_href')
                    ->required(),
                TextInput::make('first_col_href_content')
                    ->required(),
                TextInput::make('second_col_name')
                    ->required(),
                TextInput::make('second_col_href')
                    ->required(),
                TextInput::make('second_col_href_content')
                    ->required(),
                TextInput::make('first_soc_button_style')
                    ->required(),
                TextInput::make('first_soc_button_href')
                    ->required(),
                TextInput::make('second_soc_button_style')
                    ->required(),
                TextInput::make('second_soc_button_href')
                    ->required(),
                TextInput::make('third_soc_button_style')
                    ->required(),
                TextInput::make('third_soc_button_href')
                    ->required(),
                TextInput::make('fourth_soc_button_style')
                    ->required(),
                TextInput::make('fourth_soc_button_href')
                    ->required(),
                Toggle::make('login_button_status')
                    ->required(),
            ]);
    }
}
