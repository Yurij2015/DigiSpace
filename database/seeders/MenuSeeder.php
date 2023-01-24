<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'main',
                'title' => 'main menu',
                'level' => 1,
                'position' => null,
                'description' => null,
                'location' => 'header',
                'slug' => 'main',
                'href' => 'main',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'page menu first',
                'title' => 'Submenu 1',
                'level' => 2,
                'position' => 1,
                'description' => 'first submenu in pages main menu',
                'location' => 'pages_submenus',
                'slug' => 'submenu-first',
                'href' => 'submenu-first',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'page menu second',
                'title' => 'Submenu 2',
                'level' => 2,
                'position' => 2,
                'description' => 'second submenu in pages main menu',
                'location' => 'pages_submenus',
                'slug' => 'submenu-second',
                'href' => 'submenu-second',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'page menu third',
                'title' => 'Submenu 3',
                'level' => 2,
                'position' => 3,
                'description' => 'third submenu in pages main menu',
                'location' => 'pages_submenus',
                'slug' => 'submenu-third',
                'href' => 'submenu-third',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'footer submenu',
                'title' => 'Footer submenu',
                'level' => 3,
                'position' => 4,
                'description' => 'submenu in footer',
                'location' => 'footer',
                'slug' => 'footer-submenu',
                'href' => 'footer-submenu',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('menus')->insert($menus);
    }
}
