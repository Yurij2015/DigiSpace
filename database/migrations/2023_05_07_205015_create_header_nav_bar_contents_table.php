<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('header_nav_bar_contents', static function (Blueprint $table) {
            $table->id();
            $table->string('first_col_name');
            $table->string('first_col_href');
            $table->string('first_col_href_content');
            $table->string('second_col_name');
            $table->string('second_col_href');
            $table->string('second_col_href_content');
            $table->string('first_soc_button_style');
            $table->string('first_soc_button_href');
            $table->string('second_soc_button_style');
            $table->string('second_soc_button_href');
            $table->string('third_soc_button_style');
            $table->string('third_soc_button_href');
            $table->string('fourth_soc_button_style');
            $table->string('fourth_soc_button_href');
            $table->boolean('login_button_status');
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
        Schema::dropIfExists('header_nav_bar_contents');
    }
};
