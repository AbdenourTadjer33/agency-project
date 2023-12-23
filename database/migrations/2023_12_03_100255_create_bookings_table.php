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
            $table->foreignUuid('user_uuid')->constrained('users', 'uuid');
            $table->string('ref')->unique();
            $table->enum('type', ['ticketing', 'hotel', 'trip']);
            $table->nullableMorphs('bookingable');
            $table->date('date_departure');
            $table->date('date_return')->nullable();
            $table->enum('status', ['validé', 'non-validé', 'annulé'])->nullable();
            $table->string('number_adult');
            $table->string('number_child');
            $table->string('number_baby');
            $table->json('beneficiaries');
            $table->longText('observation')->nullable();
            $table->boolean('is_payed')->default(false);
            $table->boolean('is_online')->default(true);
            $table->float('price')->nullable();
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
