<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('album_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id');
            $table->foreignId('category_id');
            $table->foreign('album_id')->on('albums')->onDelete('cascade')->references('id');
            $table->foreign('category_id')->on('categories')->onDelete('cascade')->references('id');
            $table->unique(['album_id', 'category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_category');
    }
};
