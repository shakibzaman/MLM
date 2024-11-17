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
    Schema::table('payments', function (Blueprint $table) {
      $table->morphs('paymentable');
      $table->string('transaction_id')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('payments', function (Blueprint $table) {
      $table->dropMorphs('paymentable'); // Drops the morph columns: 'paymentable_id' and 'paymentable_type'
      $table->dropColumn('transaction_id');
    });
  }
};
