<?php

namespace App\Filament\Resources\PfEducationItems\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PfEducationItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('pfEducationItemLocale')->label('Translations')->relationship()->schema([Select::make('locale')->options(['en' => 'English', 'ua' => 'Українська', 'pl' => 'Polski'])->required()->distinct(), TextInput::make('title')->required(), Textarea::make('description')])->columnSpanFull(),
                Repeater::make('pfEducationItemPlace')->label('Places')->relationship()->schema([
                    TextInput::make('logoUrl'), TextInput::make('faIcon'),
                    Repeater::make('pfEducationItemPlaceLocale')->label('Place translations')->relationship()->schema([Select::make('locale')->options(['en' => 'English', 'ua' => 'Українська', 'pl' => 'Polski'])->required()->distinct(), TextInput::make('title')->required(), Textarea::make('description')]),
                ])->columnSpanFull(),
                Select::make('education_id')->relationship('pfEducation', 'name')->required()->preload(),
                TextInput::make('name')
                    ->required(),
                KeyValue::make('period')
                    ->required(),
            ]);
    }
}
