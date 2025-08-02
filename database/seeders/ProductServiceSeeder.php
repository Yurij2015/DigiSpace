<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productService = [
            [
                'product_id' => 1,
                'service_id' => 1,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'service_id' => 2,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'service_id' => 3,
                'service_css_class' => '',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'service_id' => 4,
                'service_css_class' => '',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'service_id' => 1,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'service_id' => 2,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'service_id' => 3,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'service_id' => 4,
                'service_css_class' => 'text-accent',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'service_id' => 1,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'service_id' => 2,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'service_id' => 3,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'service_id' => 4,
                'service_css_class' => 'text-marked',
                'product_css_class' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('product_service')->insert($productService);
    }
}
