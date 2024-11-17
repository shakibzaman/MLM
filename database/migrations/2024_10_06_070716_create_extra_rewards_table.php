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
        Schema::create('extra_rewards', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('reward_mapping_id');
            $table->string('status');
            $table->string('image');
            $table->string('url')->nullable();
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
        Schema::dropIfExists('extra_rewards');
    }
};
