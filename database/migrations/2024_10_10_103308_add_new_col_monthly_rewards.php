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
      Schema::table('monthly_rewards', function (Blueprint $table) {

        if (!Schema::hasColumn('monthly_rewards', 'disburse_status')) {
          $table->unsignedBigInteger('disburse_status')->default(0);
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
