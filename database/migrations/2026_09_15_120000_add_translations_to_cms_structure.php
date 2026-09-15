<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Same translations shape as 2026_09_14_000001 for the tables that build the public page
 * structure (navigation, widgets, footer, header/footer bars).
 */
return new class extends Migration
{
    private const TABLES = [
        'menus', 'menu_items', 'widgets', 'widget_categories',
        'footer_useful_links', 'header_nav_bar_contents', 'footer_bottom_bar_contents',
    ];

    public function up(): void
    {
        foreach (self::TABLES as $table) {
            Schema::table($table, static function (Blueprint $table): void {
                $table->json('translations')->nullable()->after('id');
            });
        }
    }

    public function down(): void
    {
        foreach (self::TABLES as $table) {
            Schema::table($table, static function (Blueprint $table): void {
                $table->dropColumn('translations');
            });
        }
    }
};
