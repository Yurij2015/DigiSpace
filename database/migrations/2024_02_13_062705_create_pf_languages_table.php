<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pf_languages', static function (Blueprint $table) {
            $table->id();
            $table->string('lang_code')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('subtitle_description')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_languages');
    }
};
