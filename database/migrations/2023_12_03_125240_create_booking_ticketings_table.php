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
        Schema::create('booking_ticketings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->unique()->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('flight_type', ['AR', 'AS']);
            $table->string('airport_departure');
            $table->string('airport_arrived');
            $table->string('compagnie');
            $table->enum('class', ['Pas de préférence', 'Economie', 'Affaires', 'Première']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_tecketings');
    }
};
