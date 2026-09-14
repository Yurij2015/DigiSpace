<?php

namespace App\Filament\Resources\WidgetIcons\Pages;

use App\Filament\Resources\WidgetIcons\WidgetIconResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWidgetIcon extends EditRecord
{
    protected static string $resource = WidgetIconResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
