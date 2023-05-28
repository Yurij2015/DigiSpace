<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterUsefulLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $footerUsefulLinks = [
            [
                'name' => "Laravel",
                'url' => "/",
                'status' => true,
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Symfony",
                'url' => "/",
                'status' => true,
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Vue 3",
                'url' => "/",
                'status' => true,
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "VueNotus",
                'url' => "/",
                'status' => true,
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "LteAdmin",
                'url' => "/",
                'status' => true,
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Tutorials",
                'url' => "/",
                'status' => true,
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Support",
                'url' => "/",
                'status' => true,
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],            [
                'name' => "Contact Us",
                'url' => "/",
                'status' => true,
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],            [
                'name' => "Blog",
                'url' => "/",
                'status' => true,
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('footer_useful_links')->insert($footerUsefulLinks);
    }
}
