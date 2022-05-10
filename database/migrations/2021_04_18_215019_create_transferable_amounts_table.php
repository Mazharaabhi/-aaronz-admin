<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferableAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferable_amounts', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->decimal('transferable_amount', 8, 2)->default(0);
            $table->decimal('admin_charges', 8, 2)->default(0);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('fee', 8, 2)->default(0);
            $table->decimal('total_withdrawal', 8, 2)->default(0);
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
        Schema::dropIfExists('transferable_amounts');
    }
}
