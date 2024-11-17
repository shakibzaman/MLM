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
        Schema::table('deposits', function (Blueprint $table) {
            $table->renameColumn('change_date', 'status_change_date');
            $table->string('status')->default('1')->change();
            $table->string('payment_gateway_invoice_id')->after('status')->nullable();
            $table->string('payment_gateway_status')->after('status')->nullable();
            $table->string('currency')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->renameColumn('status_change_date', 'change_date');
            $table->string('status')->default('pending')->change();
            $table->dropColumn(['payment_gateway_invoice_id', 'payment_gateway_status']);
        });
    }
};
