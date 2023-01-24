<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $posts = [
            [
                'category_id' => 1,
                'name' => 'Post 1',
                'slug' => 'post-1',
                'content' => 'Post 1',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 2',
                'slug' => 'post-2',
                'content' => 'Content 2',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 3',
                'slug' => 'post-3',
                'content' => 'Content 3',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 4',
                'slug' => 'post-4',
                'content' => 'Content 4',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 5',
                'slug' => 'post-5',
                'content' => 'Content 5',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 6',
                'slug' => 'post-6',
                'content' => 'Content 6',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 7',
                'slug' => 'post-7',
                'content' => 'Content 7',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 8',
                'slug' => 'post-8',
                'content' => 'Content 8',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 9',
                'slug' => 'post-9',
                'content' => 'Content 9',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
            [
                'category_id' => 1,
                'name' => 'Post 10',
                'slug' => 'post-10',
                'content' => 'Content 10',
                'img_path' => 'img_path',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'user_id' => 1
            ],
        ];
        DB::table('posts')->insert($posts);
    }
}
