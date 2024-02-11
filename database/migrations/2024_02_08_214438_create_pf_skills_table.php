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
        Schema::create('pf_skills', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_type_id');
            $table->foreign('skill_type_id')->references('id')->on('pf_skill_types');
            $table->string('image_icon_url')->nullable();
            $table->string('fa_icon')->nullable();
            $table->string('value')->nullable();
            $table->json('locales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_skill_items');
    }
};
