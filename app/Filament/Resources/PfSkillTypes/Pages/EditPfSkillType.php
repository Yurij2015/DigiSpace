<?php

namespace App\Filament\Resources\PfSkillTypes\Pages;

use App\Filament\Resources\PfSkillTypes\PfSkillTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSkillType extends EditRecord
{
    protected static string $resource = PfSkillTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
