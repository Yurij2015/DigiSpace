<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class LocalDevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local')) {
            throw new RuntimeException('LocalDevelopmentSeeder only runs in the local environment.');
        }

        $tables = [
            'users', 'widgets', 'widget_icons', 'pages', 'page_widget',
            'menus', 'menu_items', 'products', 'services', 'product_service',
            'categories', 'posts', 'header_nav_bar_contents',
            'footer_bottom_bar_contents', 'footer_useful_links',
        ];

        // The historical fixtures use positional foreign keys and are first-run only.
        foreach ($tables as $table) {
            if (DB::table($table)->exists()) {
                throw new RuntimeException("Refusing to seed populated table: {$table}");
            }

            $metadata = DB::selectOne(
                'SELECT AUTO_INCREMENT AS next_id FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?',
                [$table]
            );
            if ($metadata && $metadata->next_id > 1) {
                throw new RuntimeException("Expected a fresh ID sequence for table: {$table}");
            }
        }

        $imageCategories = DB::table('widget_categories')->get();
        if ($imageCategories->count() !== 1
            || $imageCategories->first()->name !== 'Images for pages'
            || ! in_array($imageCategories->first()->id, [1, 16], true)) {
            throw new RuntimeException('Expected only the image category created by migrations.');
        }

        $password = Str::password(20);

        DB::transaction(function () use ($imageCategories, $password) {
            // No widgets exist, so relocating this migration-created row is safe.
            DB::table('widget_categories')->where('id', $imageCategories->first()->id)
                ->update(['id' => 16]);

            $this->callWith(WidgetCategorySeeder::class, ['fixedIds' => true]);
            $this->call([
                WidgetSeeder::class,
                WidgetIconSeeder::class,
                UserSeeder::class,
                PageSeeder::class,
                PageWidgetSeeder::class,
                MenuSeeder::class,
                MenuItemSeeder::class,
                ProductSeeder::class,
                ServiceSeeder::class,
                ProductServiceSeeder::class,
                CategorySeeder::class,
                PostSeeder::class,
                HeaderNavBarContentSeeder::class,
                FooterBottomBarContentSeeder::class,
                FooterUsefulLinkSeeder::class,
            ]);

            DB::table('services')->get()->each(function ($service) {
                DB::table('services')->where('id', $service->id)
                    ->update(['slug' => Str::slug($service->title)]);
            });
            DB::table('posts')->update(['status' => 'published']);

            // Replace legacy credential hashes only in this new, local fixture.
            DB::table('users')->update([
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
        });

        $this->command?->info('Local content seeded. Login: admin@globaldigispace.com');
        $this->command?->line('Local password: '.$password);
    }
}
