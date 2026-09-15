<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/menu_items.json.
 */
class MenuItemSeeder extends JsonTableSeeder
{
    protected string $table = 'menu_items';
}
