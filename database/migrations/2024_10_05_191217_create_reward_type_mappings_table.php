<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateRewardTypeMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_type_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('reward_site_id')->unsigned()->nullable()->index();
            $table->integer('reward_submit_type_id')->unsigned()->nullable()->index();
            $table->string('reward_amount')->nullable();
            $table->boolean('is_active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reward_type_mappings');
    }
}
