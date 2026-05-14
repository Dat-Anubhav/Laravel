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
        Schema::create('posts', function (Blueprint $table) {
            /*This migration creates a posts table for a Laravel blog and it is mostly correct, 
            but it depends on categories and users tables already existing because category_id and user_id use constrained foreign keys 
            with cascade deletes.*/
            $table->id();
            $table->string('image')->nullable();//that may be null; typically used to store a path/filename or URL for the post’s featured image.
            $table->string('title');
            $table->string('slug')->unique(); //column for the slug (URL-friendly identifier) and creates a unique index so two posts cannot share the same slug.
            $table->longText('content');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');//means if the referenced category is deleted, all posts with that category_id will be deleted automatically. This requires a categories table to exist
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
