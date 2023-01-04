<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pages', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('meta')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->text('slug');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
