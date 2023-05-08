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
        Schema::create('footer_bottom_bar_contents', static function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('privacy_policy_title');
            $table->string('privacy_policy_href');
            $table->string('faq');
            $table->string('faq_href');
            $table->string('support');
            $table->string('support_href');
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
        Schema::dropIfExists('footer_bottom_bar_contents');
    }
};
