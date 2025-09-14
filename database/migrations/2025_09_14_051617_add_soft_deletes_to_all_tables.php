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
        // Add soft deletes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to costumers table
        Schema::table('costumers', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to ships table
        Schema::table('ships', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to rutes table
        Schema::table('rutes', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to jadwals table
        Schema::table('jadwals', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to bookings table
        Schema::table('bookings', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove soft deletes from payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from bookings table
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from jadwals table
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from rutes table
        Schema::table('rutes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from ships table
        Schema::table('ships', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from costumers table
        Schema::table('costumers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
