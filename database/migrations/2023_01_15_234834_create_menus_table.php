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
        Schema::create('menus', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->integer('level')->nullable()->comment('1, 2, 3 ...');
            $table->integer('position')->nullable()->comment('1, 2, 3 ...');
            $table->string('description')->nullable();
            $table->string('location')->nullable()->comment('header, footer...');
            $table->string('slug');
            $table->string('href');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
