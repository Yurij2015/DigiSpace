<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/footer_bottom_bar_contents.json.
 */
class FooterBottomBarContentSeeder extends JsonTableSeeder
{
    protected string $table = 'footer_bottom_bar_contents';
}
