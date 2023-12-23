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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('destination');
            $table->string('city');
            $table->foreignId('trip_category_id')->constrained('trip_categories', 'id');
            $table->enum('formule_base', ['LPD', 'LDP', 'LPC']);
            $table->json('assets');
            $table->foreignId('hotel_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
