<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('user_id');
            $table->integer('invoice_no');
            $table->integer('invoice_id');
            $table->decimal('sub_total', 8, 2);
            $table->decimal('shipping_charges', 8, 2)->default(0);
            $table->decimal('extra_charges', 8, 2)->default(0);
            $table->decimal('extra_discount', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->integer('create_by')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
