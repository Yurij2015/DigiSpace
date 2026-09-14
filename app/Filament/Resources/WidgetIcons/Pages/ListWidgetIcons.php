<?php

namespace App\Filament\Resources\WidgetIcons\Pages;

use App\Filament\Resources\WidgetIcons\WidgetIconResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWidgetIcons extends ListRecords
{
    protected static string $resource = WidgetIconResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
