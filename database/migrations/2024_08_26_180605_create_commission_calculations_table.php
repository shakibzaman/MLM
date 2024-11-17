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
        Schema::create('commission_calculations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_user_package_id');
            $table->string('label');
            $table->double('commission')->comment('In %');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_calculations');
    }
};
