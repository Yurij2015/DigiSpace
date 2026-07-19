<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Landing page',
                'price_value' => '999.99',
                'details' => 'starting at',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Website with CMS',
                'price_value' => '1499.99',
                'details' => 'starting at',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Custom development',
                'price_value' => '1999.99',
                'details' => 'starting at',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('products')->insert($products);
    }
}
