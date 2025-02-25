<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passengerID');
            $table->unsignedBigInteger('driverID')->nullable();
            $table->dateTime('deparTime');
            $table->string('pickupLocation');
            $table->string('destination');
            $table->enum('status', ['pending', 'accepted', 'canceled', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('passengerID')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('driverID')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
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
