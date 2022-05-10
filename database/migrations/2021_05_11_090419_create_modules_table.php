<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('admin_route')->nullable();
            $table->string('company_route')->nullable();
            $table->integer('status')->default(1);
            $table->integer('is_show')->default(1);
            $table->integer('sort')->default(0);
            $table->integer('is_admin')->default(0);
            $table->integer('is_company')->default(0);
            $table->string('data_id')->nullable();
            $table->string('svg')->nullable();
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
        Schema::dropIfExists('modules');
    }
}
