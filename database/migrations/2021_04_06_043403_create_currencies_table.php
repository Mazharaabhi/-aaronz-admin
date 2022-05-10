<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('from_currency')->nullable();
            $table->string('to_currency')->nullable();
            $table->string('symbol')->nullable();
            $table->decimal('rate', 8, 2)->default(0);
            $table->integer('active')->default(0)->comment('0=active, 1=not active');
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
        Schema::dropIfExists('currencies');
    }
}
