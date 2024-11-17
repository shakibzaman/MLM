<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::table('customers', function (Blueprint $table) {

        if (!Schema::hasColumn('customers', 'rank')) {
          $table->unsignedBigInteger('rank')->nullable();
        }
        if (!Schema::hasColumn('customers', 'subscription_renew_date')) {
          $table->date('subscription_renew_date')->nullable();
        }
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
