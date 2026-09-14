<?php

namespace App\Filament\Resources\PfSkillSubcategories\Pages;

use App\Filament\Resources\PfSkillSubcategories\PfSkillSubcategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPfSkillSubcategory extends EditRecord
{
    protected static string $resource = PfSkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
