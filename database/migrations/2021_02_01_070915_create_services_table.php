<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title_english')->nullable();
            $table->string('title_arabic')->nullable();
            $table->string('short_title_english')->nullable();
            $table->string('short_title_arabic')->nullable();
            $table->text('image')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('parent')->default(0);
            $table->integer('is_active')->default(1)->comment('1=active, 0=deactive');
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
        Schema::dropIfExists('services');
    }
}
