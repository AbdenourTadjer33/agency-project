<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->foreignId('trip_category_id')
                ->constrained('trip_categories', 'id')
                ->onDelete('cascade');
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
