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
        Schema::create('pf_subcategories', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->references('id')->on('pf_sections');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->json('progress')->nullable();
            $table->string('fa_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_subcategories');
    }
};
