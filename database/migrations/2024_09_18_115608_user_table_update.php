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
        $table->boolean('auth_2fa')->default(0);
        $table->string('two_factor_code')->nullable();
        $table->dateTime('two_factor_code_expire_at')->nullable();
      });

      Schema::table('customers', function (Blueprint $table) {
        $table->dropColumn('2fa _auth');
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
