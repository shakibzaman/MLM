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
        Schema::create('point_converts', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('point');
            $table->string('doller');
            $table->string('status')->default(1);
            $table->string('status_change_by')->nullable();
            $table->string('status_change_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_converts');
    }
};
