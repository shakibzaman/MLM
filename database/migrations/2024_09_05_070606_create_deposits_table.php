<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('hash_id')->nullable();
            $table->integer('customer_id')->unsigned()->nullable()->index();
            $table->string('amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('gateway')->nullable();
            $table->string('status')->default('pending');
            $table->string('status_change_by')->nullable();
            $table->string('change_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deposits');
    }
}
