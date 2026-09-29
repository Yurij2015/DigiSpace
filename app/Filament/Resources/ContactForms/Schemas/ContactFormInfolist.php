<?php

namespace App\Filament\Resources\ContactForms\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactFormInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('first_name'),
            TextEntry::make('last_name'),
            TextEntry::make('email')
                ->copyable(),
            TextEntry::make('phone')
                ->copyable(),
            TextEntry::make('source')
                ->badge(),
            TextEntry::make('message')
                ->columnSpanFull(),
            TextEntry::make('created_at')
                ->dateTime(),
            TextEntry::make('updated_at')
                ->dateTime(),
        ]);
    }
}
