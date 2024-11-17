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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('ip_address')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->tinyInteger('document_verified')->default(0);
            $table->tinyInteger('2fa _auth')->default(0);
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('lifetime_package')->nullable();
            $table->unsignedBigInteger('monthly_package')->nullable();
            $table->string('monthly_package_status')->default('inactive');
            $table->date('monthly_package_enrolled_at')->nullable();
            $table->unsignedBigInteger('reference_user')->nullable();
            $table->double('balance')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
