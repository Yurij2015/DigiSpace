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
        Schema::create('pf_links', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->nullable()->references('id')->on('pf_section_items');
            $table->string('fa_icon')->nullable();
            $table->string('href')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_links');
    }
};
