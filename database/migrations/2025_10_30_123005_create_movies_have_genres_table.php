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
        Schema::create('movies_have_genres', function (Blueprint $table) {

            $table->foreignId('movie_fk')->constrained(table:'movies', column:'movie_id');
            $table->unsignedSmallInteger('genre_fk');
            $table->foreign('genre_fk')->references('genre_id')->on('genres');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies_have_genres');
    }
};
