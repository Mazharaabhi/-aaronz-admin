<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->decimal('amount', 8, 2)->default(0);
            $table->decimal('admin_charges', 8, 2)->default(0);
            $table->text('reason')->nullable();
            $table->integer('modify')->default(0);
            $table->integer('status')->default(0)->comment('0 = pending, 1 = complated, 2= rejected');
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
        Schema::dropIfExists('withdrawals');
    }
}
