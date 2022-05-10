<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->decimal('fixed_cost', 8,2)->default(0);
            $table->decimal('service_fee', 8,2)->default(0);
            $table->decimal('tax', 8,2)->default(0);
            $table->decimal('gross_profit', 8,2)->default(0);
            $table->decimal('net_profit', 8,2)->default(0);
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
        Schema::dropIfExists('profit_accounts');
    }
}
