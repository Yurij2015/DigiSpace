<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/widget_categories.json.
 */
class WidgetCategorySeeder extends JsonTableSeeder
{
    protected string $table = 'widget_categories';
}
