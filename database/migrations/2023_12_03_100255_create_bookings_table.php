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
            $table->id();
            $table->morphs('bookingable');
            $table->date('date_departure');
            $table->date('date_return');
            $table->enum('status', ['validé', 'non-validé', 'annulé']);
            $table->string('numbre_adult');
            $table->string('number_child');
            $table->string('number_baby');
            $table->boolean('is_payed');
            $table->boolean('is_online');
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
