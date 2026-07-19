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
        Schema::table('services', static function (Blueprint $table) {
            $table->string('slug', 255)->unique('slug')->nullable()->after('price');
            $table->text('description')->nullable()->after('price');
            $table->string('image')->nullable()->after('price');
            $table->string('image_alt')->nullable()->after('price');
            $table->string('seo_title')->nullable()->after('price');
            $table->text('seo_description')->nullable()->after('price');
            $table->string('seo_keywords')->nullable()->after('price');
            $table->integer('service_category_id')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', static function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('image');
            $table->dropColumn('image_alt');
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_keywords');
            $table->dropColumn('service_category_id');
        });
    }
};
