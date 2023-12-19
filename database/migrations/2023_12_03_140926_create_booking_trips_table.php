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
        Schema::create('booking_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->enum('formule', ['LPD', 'LDP', 'LPC']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_trips');
    }
};
