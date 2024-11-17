<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rank_rewards', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->double('bonus')->nullable();
            $table->string('minimum_referrals')->nullable();
            $table->string('direct_referrals')->nullable();
            $table->string('active_subscribers')->nullable();
            $table->double('earnings')->nullable();
            $table->string('days')->nullable();
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
        Schema::drop('rank_rewards');
    }
}
