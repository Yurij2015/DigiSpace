<?php

namespace App\Filament\Resources\PfSections\Pages;

use App\Filament\Resources\PfSections\PfSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSection extends EditRecord
{
    protected static string $resource = PfSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
