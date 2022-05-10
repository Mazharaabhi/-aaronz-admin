<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('bank_name')->nullable();
            $table->string('bic')->nullable();
            $table->string('account_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('account_no')->nullable();
            $table->string('currency');
            $table->string('reason')->nullable();
            $table->integer('status')->default(0)->comment('1=pending, 2=accepted, 3=rejected');
            $table->integer('is_active')->default(0)->comment('0=not active, 1=active');
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
        Schema::dropIfExists('banks');
    }
}
