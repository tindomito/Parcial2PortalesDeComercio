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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');

            $table->foreignId('event_fk')->constrained('events', 'event_id')->onDelete('cascade');
            $table->foreignId('user_fk')->constrained('users', 'id')->onDelete('cascade');

            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('total_price');
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
