<?php

namespace App\Filament\Resources\PfSectionItems\Pages;

use App\Filament\Resources\PfSectionItems\PfSectionItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSectionItem extends EditRecord
{
    protected static string $resource = PfSectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
