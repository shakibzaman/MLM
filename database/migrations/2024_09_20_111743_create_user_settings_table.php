<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('min_password_length')->default(0);
            $table->string('max_password_length')->default(0);
            $table->string('password_for_withdraw')->default(0);
            $table->string('confirm_code_account_update')->default(0);
            $table->string('notify_status')->default(0);
            $table->string('subscription_type')->nullable();
            $table->string('password_for_edit_profile')->default(0);
            $table->string('email_change_status')->default(0);
            $table->string('subscription_status')->default(0);
            $table->string('subscription_grace_period')->nullable();
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
        Schema::drop('user_settings');
    }
}
