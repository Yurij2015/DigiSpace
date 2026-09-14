<?php

namespace App\Filament\Resources\PfEducationItems\Pages;

use App\Filament\Resources\PfEducationItems\PfEducationItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfEducationItem extends EditRecord
{
    protected static string $resource = PfEducationItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
