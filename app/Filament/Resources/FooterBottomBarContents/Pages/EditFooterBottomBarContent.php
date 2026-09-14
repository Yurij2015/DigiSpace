<?php

namespace App\Filament\Resources\FooterBottomBarContents\Pages;

use App\Filament\Resources\FooterBottomBarContents\FooterBottomBarContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterBottomBarContent extends EditRecord
{
    protected static string $resource = FooterBottomBarContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
