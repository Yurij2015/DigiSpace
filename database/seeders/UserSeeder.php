<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "admin",
                "email" => "admin2@globaldigispace.com",
                "email_verified_at" => null,
                "password" => '$2y$10$g3M2HzL6SK0Useh53xvRheuOHXDcmLBC/5NoeL8.9p/mou4K4Y86u',
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "admin2",
                "email" => "admin@globaldigispace.com",
                "email_verified_at" => null,
                "password" => '$2y$10$g3M2HzL6SK0Useh53xvRheuOHXDcmLBC/5NoeL8.9p/mou4K4Y86u',
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "admin3",
                "email" => "admin3@globaldigispace.com",
                "email_verified_at" => null,
                "password" => '$2y$10$g3M2HzL6SK0Useh53xvRheuOHXDcmLBC/5NoeL8.9p/mou4K4Y86u',
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];
        DB::table('users')->delete();
        DB::table('users')->insert($users);
    }
}
