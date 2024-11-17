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
            $table->string('init_lifetime_package')->nullable();
            $table->string('member_cover_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (Schema::hasColumn('customers', 'init_lifetime_package')) {
                $table->dropColumn('init_lifetime_package');
            }
            if (Schema::hasColumn('customers', 'member_cover_image')) {
                $table->dropColumn('member_cover_image');
            }
            if (Schema::hasColumn('customers', 'state')) {
                $table->dropColumn('state');
            }
        });
    }
};
