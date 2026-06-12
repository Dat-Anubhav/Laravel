<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string("color")->nullable()->change();
            $table->string("image")->nullable()->change();
            $table->date("published_at")->nullable()->change();
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->string("name")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string("color")->nullable(false)->change();
            $table->string("image")->nullable(false)->change();
            $table->date("published_at")->nullable(false)->change();
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->string("name")->nullable(false)->change();
        });
    }
};
