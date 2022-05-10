<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('real_password')->nullable();
            $table->string('phone_code')->default('+971');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('designation')->nullable();
            $table->text('avatar')->nullable();
            $table->text('address')->nullable();
            $table->text('token')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('ip')->nullable();
            $table->string('company_prefix')->nullable();
            $table->string('cart_number')->nullable();
            $table->string('zip')->nullable();
            $table->text('redirect_url')->nullable();
            $table->text('tran_ref')->nullable();
            $table->integer('company_id')->default(0);
            $table->integer('company_profile')->default(0)->comment('1=tokenise, 0=normal');
            $table->integer('payment_status')->default(0)->comment('1=true, 0=false');
            $table->integer('branded_pay_page')->default(0)->comment('1=true, 0=false');
            $table->integer('branded_email')->default(0)->comment('1=true, 0=false');
            $table->integer('withdraw_limit')->default(0);
            $table->integer('user_role')->default(2)->comment('1=admin, 2=company, 3=customer');
            $table->integer('role_id')->default(0);
            $table->integer('customer_from')->default(0)->comment('1=link, 2=invoice');
            $table->integer('is_active')->default(1)->comment('0=deactive, 1=active');
            $table->integer('is_verified')->default(0)->comment('0=not-verified, 1=verified');
            $table->text('callback_url')->nullable();
            $table->text('callback')->nullable();
            $table->integer('user_type')->default(0)->comment('1=invoice, 0=payment_link');
            $table->integer('available_limit')->default(0);
            $table->string('sender_id_by_number')->nullable();
            $table->string('sender_id_by_name')->nullable();
            $table->string('secrate_key')->nullable();
            $table->string('api_key')->nullable();
            $table->integer('sms_limit')->default(0);
            $table->integer('remaining_sms')->default(0);
            $table->integer('create_by')->default(0);
            $table->integer('modify_by')->default(0);
            $table->integer('active_sms_id')->default(0)->comment('0=id, 1=name');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
