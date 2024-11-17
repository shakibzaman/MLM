<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('request_type')->nullable();
            $table->morphs('purchasable');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('status')->default('pending')->nullable();
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
        Schema::drop('purchase_requests');
    }
}
