<?php

namespace App\Filament\Resources\HeaderNavBarContents\Pages;

use App\Filament\Resources\HeaderNavBarContents\HeaderNavBarContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHeaderNavBarContent extends EditRecord
{
    protected static string $resource = HeaderNavBarContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
