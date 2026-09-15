<?php

namespace App\Filament\Resources\Widgets\Pages;

use App\Filament\Resources\Widgets\WidgetResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWidget extends EditRecord
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
