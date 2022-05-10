<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->text('header_logo')->nullable();
            $table->string('header_logo_width')->nullable();
            $table->string('header_logo_height')->nullable();
            $table->text('banner')->nullable();
            $table->string('banner_width')->nullable();
            $table->string('banner_height')->nullable();
            $table->string('company_name')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('footer_color')->nullable();
            $table->string('footer_text_color')->nullable();
            $table->string('footer_link_color')->nullable();
            $table->text('footer_logo')->nullable();
            $table->string('footer_logo_width')->nullable();
            $table->string('footer_logo_height')->nullable();
            $table->text('term_link')->nullable();
            $table->text('policy_link')->nullable();
            $table->text('fb')->nullable();
            $table->text('linked_in')->nullable();
            $table->text('instagram')->nullable();
            $table->text('google_my_business')->nullable();
            $table->text('youtube')->nullable();
            $table->text('twitter')->nullable();
            $table->text('email')->nullable();
            $table->text('mobile')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('address')->nullable();
            $table->integer('create_by')->default(0);
            $table->integer('modify_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_settings');
    }
}
