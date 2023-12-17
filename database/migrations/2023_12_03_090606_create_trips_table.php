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
            $table->string('category');
            $table->enum('formule_base', ['petit-dej', 'demi-pension', 'pension-complete']);
            $table->json('assets');
            $table->foreignId('hotel_id')->nullable()->constrained();
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
