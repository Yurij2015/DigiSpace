<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('generation_configs', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type')->unique();
            $table->string('entity_name');
            $table->text('entity_description');
            $table->json('fields');
            $table->json('seo_fields');
            $table->text('default_prompt')->nullable();
            $table->text('system_prompt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('generation_configs');
    }
};
