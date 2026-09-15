<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/categories.json.
 */
class CategorySeeder extends JsonTableSeeder
{
    protected string $table = 'categories';
}
