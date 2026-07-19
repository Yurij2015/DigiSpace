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
        Schema::create('pf_section_items', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->references('id')->on('pf_sections');
            $table->foreignId('subcategory_id')->nullable()->references('id')->on('pf_subcategories');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->foreignId('place_id')->nullable()->references('id')->on('pf_places');
            $table->json('period')->nullable();
            $table->string('image_icon_url')->nullable();
            $table->string('fa_icon')->nullable();
            $table->string('value')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('href')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_section_items');
    }
};
