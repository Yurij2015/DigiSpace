<?php

namespace App\Filament\Resources\FooterUsefulLinks\Pages;

use App\Filament\Resources\FooterUsefulLinks\FooterUsefulLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterUsefulLink extends EditRecord
{
    protected static string $resource = FooterUsefulLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
