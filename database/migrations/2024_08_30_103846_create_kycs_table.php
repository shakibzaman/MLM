<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kycs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('customer_id')->unsigned()->nullable()->index();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kycs');
    }
}
