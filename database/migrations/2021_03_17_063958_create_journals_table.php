<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('company_from')->default(0);
            $table->integer('withdrawal_id');
            $table->text('type')->nullable();
            $table->text('narration')->nullable();
            $table->decimal('cr', 8, 2)->default(0);
            $table->decimal('dr', 8, 2)->default(0);
            $table->string('previous_balance')->nullable();
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
        Schema::dropIfExists('journals');
    }
}
