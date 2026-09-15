<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/footer_useful_links.json.
 */
class FooterUsefulLinkSeeder extends JsonTableSeeder
{
    protected string $table = 'footer_useful_links';
}
