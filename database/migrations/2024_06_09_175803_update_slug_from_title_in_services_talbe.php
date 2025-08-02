<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('services')->get()->each(function ($row) {
            $firstWord = explode(' ', $row->title)[0];
            $slug = Str::slug($row->title);
            $count = DB::table('services')->where('title', $row->title)->count();

            if ($count > 1) {
                $slug .= '-'.Str::slug($firstWord).Str::random(2);
            }

            DB::table('services')->where('id', $row->id)->update(['slug' => $slug]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
