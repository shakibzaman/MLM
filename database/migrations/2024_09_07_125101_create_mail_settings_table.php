<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_from_name')->nullable();
            $table->string('email_from_address')->nullable();
            $table->string('mailing_driver')->default('smtp');
            $table->string('mail_user_name')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('smpt_host')->nullable();
            $table->string('smpt_port')->nullable();
            $table->string('smtp_secure')->nullable();
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
        Schema::drop('mail_settings');
    }
}
