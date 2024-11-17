<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePluginSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->text('tawk_property_id')->nullable();
            $table->text('tawk_widget_id')->nullable();
            $table->text('google_recaptcha_key')->nullable();
            $table->text('google_recaptcha_secret')->nullable();
            $table->text('google_analytics_id')->nullable();
            $table->text('fb_page_id')->nullable();
            $table->text('pusher_app_id')->nullable();
            $table->text('pusher_app_key')->nullable();
            $table->text('pusher_secret')->nullable();
            $table->text('pusher_cluster')->nullable();
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
        Schema::drop('plugin_settings');
    }
}
