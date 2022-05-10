<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaytabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paytabs', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->text('server_key')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('cart_id')->nullable();
            $table->integer('active')->comment('0=not active, 1= active');
            $table->integer('type')->comment('1=merchant, 2=sandbox');
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
        Schema::dropIfExists('paytabs');
    }
}
