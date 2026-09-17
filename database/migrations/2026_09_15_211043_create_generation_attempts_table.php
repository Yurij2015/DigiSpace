<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('generation_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('generation')->index();
            $table->string('entity_type')->index();
            $table->nullableMorphs('generatable');
            $table->unsignedInteger('attempt_number');
            $table->string('locale', 5);
            $table->string('translation_mode')->nullable();
            $table->text('user_prompt');
            $table->text('resolved_prompt');
            $table->json('source_content')->nullable();
            $table->json('generated_payload');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('generation_attempts');
    }
};
