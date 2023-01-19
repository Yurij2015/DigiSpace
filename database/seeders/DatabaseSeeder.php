<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(WidgetCategorySeeder::class);
        $this->call(WidgetSeeder::class);
        $this->call(WidgetIconSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PageWidgetSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuItemSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ProductServiceSeeder::class);
    }
}
