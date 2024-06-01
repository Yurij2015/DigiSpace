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
        Schema::table('services', static function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive', 'pending', 'suspended'])->default('inactive')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', static function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
