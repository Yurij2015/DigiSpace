<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = [
            [
                'title' => "Basic",
                'price_value' => '399.99',
                'details' => 'starting at',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Optimal',
                'price_value' => '599.99',
                'details' => 'starting at',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => "Ultimate",
                'price_value' => '999.99',
                'details' => 'starting at',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('products')->insert($products);
    }
}
