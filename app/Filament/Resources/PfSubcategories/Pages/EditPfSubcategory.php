<?php

namespace App\Filament\Resources\PfSubcategories\Pages;

use App\Filament\Resources\PfSubcategories\PfSubcategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSubcategory extends EditRecord
{
    protected static string $resource = PfSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
