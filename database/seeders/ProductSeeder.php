<?php

namespace Database\Seeders;

use Database\Seeders\Support\JsonTableSeeder;

/**
 * Rows and their en/uk/pl values live in database/seeders/data/products.json.
 */
class ProductSeeder extends JsonTableSeeder
{
    protected string $table = 'products';
}
