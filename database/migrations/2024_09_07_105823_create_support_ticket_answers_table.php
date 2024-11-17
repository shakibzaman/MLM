<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_ticket_answers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('support_ticket_id')->unsigned()->nullable()->index();
            $table->string('answer')->nullable();
            $table->integer('user_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('support_ticket_answers');
    }
}
