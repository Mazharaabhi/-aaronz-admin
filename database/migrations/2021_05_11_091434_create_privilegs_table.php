<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilegs', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('role_id');
            $table->integer('module_id');
            $table->integer('operation_id');
            $table->integer('is_view')->default(0);
            $table->integer('is_add')->default(0);
            $table->integer('is_edit')->default(0);
            $table->integer('is_status')->default(0);
            $table->integer('is_delete')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('privilegs');
    }
}
