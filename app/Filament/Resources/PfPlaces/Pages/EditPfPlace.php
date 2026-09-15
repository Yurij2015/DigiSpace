<?php

namespace App\Filament\Resources\PfPlaces\Pages;

use App\Filament\Resources\PfPlaces\PfPlaceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfPlace extends EditRecord
{
    protected static string $resource = PfPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
