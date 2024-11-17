<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('site_logo')->nullable();
            $table->string('site_fevicon')->nullable();
            $table->string('admin_login_cover')->nullable();
            $table->string('site_admin_prefix')->nullable();
            $table->string('site_currency_type')->nullable();
            $table->string('site_currency')->nullable();
            $table->string('timezon')->nullable();
            $table->string('referral_type')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('referral_code_Limit')->nullable();
            $table->string('home_redirect')->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_email')->nullable();
            $table->string('support_email')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('global_settings');
    }
}
