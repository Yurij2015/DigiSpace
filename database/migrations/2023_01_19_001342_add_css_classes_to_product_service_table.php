<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('product_service', static function (Blueprint $table) {
            $table->string('service_css_class')->nullable();
            $table->string('product_css_class')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('product_service', static function (Blueprint $table) {
            $table->dropColumn('service_css_class');
            $table->dropColumn('product_css_class');
        });
    }
};
