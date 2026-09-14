<?php

namespace App\Filament\Resources\PfSkills\Pages;

use App\Filament\Resources\PfSkills\PfSkillsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSkills extends EditRecord
{
    protected static string $resource = PfSkillsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
