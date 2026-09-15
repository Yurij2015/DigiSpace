<?php

namespace App\Filament\Support;

use App\Models\Concerns\HasTranslatableColumns;
use Illuminate\Database\Eloquent\Model;

/**
 * For EditRecord pages of models using HasLocalizedContent: fill the form from the raw
 * base-language columns instead of the locale-aware accessors, so the English tab always
 * shows English and saving never copies a uk/pl translation into the base columns.
 * The model lists its base columns through HasTranslatableColumns::translatableColumns().
 */
trait FillsRawTranslatableFields
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Model&HasTranslatableColumns $record */
        $record = $this->getRecord();

        foreach ($record::translatableColumns() as $field) {
            $data[$field] = $record->getRawOriginal($field);
        }

        $translations = $record->getRawOriginal('translations');
        $data['translations'] = is_string($translations) ? json_decode($translations, true) : $translations;

        return $data;
    }
}
