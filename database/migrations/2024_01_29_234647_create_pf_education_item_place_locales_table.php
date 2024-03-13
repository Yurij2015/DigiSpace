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
        Schema::create('pf_education_item_place_locales', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_item_place_id')->constrained('pf_education_item_places')->cascadeOnDelete();
            $table->string('locale');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_education_item_place_locales');
    }
};
