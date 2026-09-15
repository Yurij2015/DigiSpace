<?php

namespace App\Models\Concerns;

/**
 * Implemented by models using HasLocalizedContent: names the base-language columns
 * that also live under translations.{locale}.
 */
interface HasTranslatableColumns
{
    /** @return list<string> */
    public static function translatableColumns(): array;
}
