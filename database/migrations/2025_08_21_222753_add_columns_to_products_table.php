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
        Schema::table('products', static function (Blueprint $table) {
            $table->string('product_code')->nullable()->after('id');
            $table->string('product_name')->nullable()->after('product_code');
            $table->text('description')->nullable()->after('product_name');
            $table->boolean('is_active')->default(true)->after('description');
            $table->integer('position')->nullable()->after('description');
            $table->boolean('is_prefered')->default(false)->after('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', static function (Blueprint $table) {
            $table->dropColumn(['product_code', 'product_name', 'description', 'is_active', 'is_prefered']);
        });
    }
};
