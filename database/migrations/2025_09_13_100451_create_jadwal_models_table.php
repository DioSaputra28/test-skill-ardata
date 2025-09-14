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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->foreignId('rute_id')->constrained('rutes', 'rute_id')->onDelete('cascade');
            $table->foreignId('ship_id')->constrained('ships', 'ship_id')->onDelete('cascade');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->string('status');
            $table->integer('price');
            $table->integer('seats_kuota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
