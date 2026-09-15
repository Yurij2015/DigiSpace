<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/menus.json.
 */
class MenuSeeder extends JsonTableSeeder
{
    protected string $table = 'menus';
}
