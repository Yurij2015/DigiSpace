<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Category 1',
                'description' => 'Category 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1,
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
