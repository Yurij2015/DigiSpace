<?php

namespace App\Filament\Resources\FooterBottomBarContents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FooterBottomBarContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->required(),
                TextInput::make('privacy_policy_title')
                    ->required(),
                TextInput::make('privacy_policy_href')
                    ->required(),
                TextInput::make('faq')
                    ->required(),
                TextInput::make('faq_href')
                    ->required(),
                TextInput::make('support')
                    ->required(),
                TextInput::make('support_href')
                    ->required(),
            ]);
    }
}
