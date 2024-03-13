<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pf_locales', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->references('id')->on('pf_sections');
            $table->foreignId('item_id')->nullable()->references('id')->on('pf_section_items');
            $table->foreignId('place_id')->nullable()->references('id')->on('pf_places');
            $table->foreignId('subcategory_id')->nullable()->references('id')->on('pf_subcategories');
            $table->foreignId('en_id')->nullable()->references('id')->on('pf_languages');
            $table->foreignId('ua_id')->nullable()->references('id')->on('pf_languages');
            $table->foreignId('pl_id')->nullable()->references('id')->on('pf_languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_locales');
    }
};
