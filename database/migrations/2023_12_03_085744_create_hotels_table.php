<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->unique();
            $table->string('slug')->nullable()->unique();
            $table->longText('description')->nullable();
            $table->string('country')->nullable();
            $table->string('city', 64)->nullable();
            $table->string('address', 128)->nullable();
            $table->json('coordinates')->nullable();
            $table->integer('classification')->nullable();
            $table->integer('number_rooms')->nullable();
            $table->json('services')->nullable();
            $table->json('assets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
