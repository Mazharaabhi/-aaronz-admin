<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('company_id');
            $table->integer('tran_id');
            $table->string('tran_ref')->nullable();
            $table->string('cart_amount');
            $table->string('cart_id');
            $table->text('token')->nullable();
            $table->string('tran_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('tran_time')->nullable();
            $table->string('currency')->nullable();
            $table->text('description')->nullable();
            $table->text('redirect_url')->nullable();
            $table->integer('invoice_id')->default(0);
            $table->integer('tran_count')->default(0);
            $table->integer('conversion_rate')->default(0);
            $table->integer('conversion_amount')->default(0);
            $table->integer('transferable_amount')->default(0);
            $table->string('customer_ref')->nullable();
            $table->string('invoice_ref')->nullable();
            $table->text('resp_msg')->nullable();
            $table->text('resp_code')->nullable();
            $table->string('refund_resp')->nullable();
            $table->integer('account_type')->comment('1=merchant, 2=sandbox');
            $table->integer('resource')->default(1)->comment('1=internal, 2=external');
            $table->string('status')->nullable()->comment('A=Authorized, H=hold, V=Voided, E=Error, D=Decline');
            $table->integer('type')->default(2)->comment('1=Link, 2=Charge, 3=Invoice, 4=Invoice Charge');
            $table->integer('is_delete')->default(0)->comment('1=delete, 0=not delete');
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}
