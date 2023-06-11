<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::table('widget_categories')->insert([
            'name' => 'Images for pages',
            'title' => 'Images for pages',
            'description' => 'Images for pages',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
};
