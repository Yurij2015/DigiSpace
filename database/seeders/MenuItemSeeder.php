<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = [
            [
                'menu_id' => '1',
                'name' => 'About',
                'slug' => 'about',
                'href' => 'about',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '1',
                'name' => 'Services',
                'slug' => 'services',
                'href' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '1',
                'name' => 'Pricing',
                'slug' => 'pricing',
                'href' => 'pricing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '1',
                'name' => 'Promos',
                'slug' => 'promos',
                'href' => 'promos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '1',
                'name' => 'Blog',
                'slug' => 'blog',
                'href' => 'blog',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '1',
                'name' => 'Pages',
                'slug' => 'pages',
                'href' => 'pages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '1',
                'name' => 'Contact us',
                'slug' => 'contact-us',
                'href' => 'contact-us',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '2',
                'name' => 'Page 1',
                'slug' => 'page-1',
                'href' => 'pages/page1.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '2',
                'name' => 'Page 2',
                'slug' => 'page-2',
                'href' => 'pages/page2.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '2',
                'name' => 'Page 3',
                'slug' => 'page-3',
                'href' => 'pages/page3.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '3',
                'name' => 'Page 4',
                'slug' => 'page-4',
                'href' => 'pages/page4.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '3',
                'name' => 'Page 5',
                'slug' => 'page-5',
                'href' => 'pages/page5.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '3',
                'name' => 'Page 6',
                'slug' => 'page-6',
                'href' => 'pages/page6.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '4',
                'name' => 'Page 7',
                'slug' => 'page-7',
                'href' => 'pages/page7.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 1',
                'slug' => 'useful-link-1',
                'href' => 'pages/useful-link-1.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 2',
                'slug' => 'useful-link-2',
                'href' => 'pages/useful-link-2.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 3',
                'slug' => 'useful-link-3',
                'href' => 'pages/useful-link-3.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 4',
                'slug' => 'useful-link-4',
                'href' => 'pages/useful-link-4.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 5',
                'slug' => 'useful-link-5',
                'href' => 'pages/useful-link-5.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 6',
                'slug' => 'useful-link-6',
                'href' => 'pages/useful-link-6.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 7',
                'slug' => 'useful-link-7',
                'href' => 'pages/useful-link-7.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 8',
                'slug' => 'useful-link-8',
                'href' => 'pages/useful-link-8.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => '5',
                'name' => 'Useful link 9',
                'slug' => 'useful-link-9',
                'href' => 'pages/useful-link-9.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('menu_items')->insert($menuItems);
    }
}
