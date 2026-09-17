<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('generation_attempts', function (Blueprint $table) {
            $table->string('request_id')->nullable()->after('id')->index();
            $table->string('status')->nullable()->after('request_id');
            $table->json('rag_sources')->nullable()->after('generated_payload');
        });
    }

    public function down(): void
    {
        Schema::table('generation_attempts', function (Blueprint $table) {
            $table->dropIndex(['request_id']);
            $table->dropColumn(['request_id', 'status', 'rag_sources']);
        });
    }
};
