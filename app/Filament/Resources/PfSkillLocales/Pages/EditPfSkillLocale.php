<?php

namespace App\Filament\Resources\PfSkillLocales\Pages;

use App\Filament\Resources\PfSkillLocales\PfSkillLocaleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSkillLocale extends EditRecord
{
    protected static string $resource = PfSkillLocaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
