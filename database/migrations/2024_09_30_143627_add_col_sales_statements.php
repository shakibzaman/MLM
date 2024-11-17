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
      Schema::table('sales_statements', function (Blueprint $table) {

        if (!Schema::hasColumn('sales_statements', 'type')) {
          $table->string('type')->nullable();
        }
        if (!Schema::hasColumn('sales_statements', 't_type')) {
          $table->integer('t_type')->default(1)->comment('1 =  income 2 = expense');
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
