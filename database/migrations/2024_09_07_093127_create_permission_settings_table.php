<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('email_verification')->nullable();
            $table->boolean('kyc_verification')->nullable();
            $table->boolean('two_fa_verification')->nullable();
            $table->boolean('account_creation')->nullable();
            $table->boolean('user_deposit')->nullable();
            $table->boolean('user_withdraw')->nullable();
            $table->boolean('user_send_money')->nullable();
            $table->boolean('user_referral')->nullable();
            $table->boolean('signup_bonus')->nullable();
            $table->boolean('investment_referral_bounty')->nullable();
            $table->boolean('deposit_referral_bounty')->nullable();
            $table->boolean('site_animation')->nullable();
            $table->boolean('site_back_to_top')->nullable();
            $table->boolean('development_mode')->nullable();
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
        Schema::drop('permission_settings');
    }
}
