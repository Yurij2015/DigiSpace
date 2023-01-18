<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $productService = [
            [
                'product_id' => 1,
                'service_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'service_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'service_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'service_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'service_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'service_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'service_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'service_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('product_service')->insert($productService);
    }
}
