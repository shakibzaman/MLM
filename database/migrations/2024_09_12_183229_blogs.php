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
        Schema::create('blogs', function (Blueprint $table){
          $table->id();
          $table->string('title');
          $table->integer('blog_category_id')->unsigned()->nullable()->index();
          $table->string('source')->nullable();
          $table->boolean('blog_seo')->nullable();
          $table->string('meta_tag')->nullable();
          $table->text('description')->nullable();
          $table->text('meta_description')->nullable();
          $table->string('tag')->nullable();
          $table->boolean('is_active')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::drop('blogs');
    }
};
