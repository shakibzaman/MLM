<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 255)->nullable();
            $table->string('contact_person')->nullable();
            $table->string('referral_link_identifier')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('legal_name')->nullable();
            $table->string('google_secret_key')->nullable();
            $table->string('captcha_at_register')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('company_start_on')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('google_analytic_key')->nullable();
            $table->string('captcha_at_client_registration')->nullable();
            $table->string('tagline')->nullable();
            $table->string('google_site_key')->nullable();
            $table->string('google_webmaster_tool_code')->nullable();
            $table->string('captcha_at_admin_login')->nullable();
            $table->string('we_accept_logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company_settings');
    }
}
