<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $services = [
            [
                'title' => "Concept development",
                'details' => null,
                'price' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => "UI design",
                'details' => null,
                'price' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => "Configuration management",
                'details' => null,
                'price' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => "Software quality assurance",
                'details' => null,
                'price' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('services')->insert($services);
    }
}
