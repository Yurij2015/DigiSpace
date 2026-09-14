<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['posts', 'pages', 'services', 'service_categories', 'products', 'categories'] as $table) {
            Schema::table($table, static function (Blueprint $table): void {
                $table->json('translations')->nullable()->after('id');
            });
        }
    }

    public function down(): void
    {
        foreach (['posts', 'pages', 'services', 'service_categories', 'products', 'categories'] as $table) {
            Schema::table($table, static function (Blueprint $table): void {
                $table->dropColumn('translations');
            });
        }
    }
};
