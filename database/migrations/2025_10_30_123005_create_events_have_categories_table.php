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
        Schema::create('events_have_categories', function (Blueprint $table) {

            $table->foreignId('event_fk')->constrained(table:'events', column:'event_id');
            $table->unsignedSmallInteger('category_fk');
            $table->foreign('category_fk')->references('category_id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_have_categories');
    }
};
