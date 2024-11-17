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

        if (!Schema::hasColumn('customers', 'unique_id')) {
          $table->unsignedBigInteger('unique_id')->index()->default(0);
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
