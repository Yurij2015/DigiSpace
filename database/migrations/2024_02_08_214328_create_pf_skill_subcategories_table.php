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
        Schema::create('pf_skill_subcategories', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_type_id');
            $table->foreign('skill_type_id')->references('id')->on('pf_skill_types');
            $table->string('progress')->nullable();
            $table->string('type');
            $table->string('fa_icon');
            $table->json('locales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_skill_subcategories');
    }
};
