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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('costumer_id')->constrained('costumers', 'costumer_id')->onDelete('cascade');
            $table->foreignId('jadwal_id')->constrained('jadwals', 'jadwal_id')->onDelete('cascade');
            $table->string('booking_code')->unique();
            $table->string('token');
            $table->integer('seats_total');
            $table->integer('total_price');
            $table->timestamp('booked_at')->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
