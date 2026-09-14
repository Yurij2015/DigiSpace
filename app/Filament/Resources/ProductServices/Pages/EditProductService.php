<?php

namespace App\Filament\Resources\ProductServices\Pages;

use App\Filament\Resources\ProductServices\ProductServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductService extends EditRecord
{
    protected static string $resource = ProductServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
