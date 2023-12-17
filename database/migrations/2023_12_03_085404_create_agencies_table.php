<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->json('networks');
        });

        DB::table('agencies')->insert([
            'id' => 1,
            'networks' => json_encode([
                'facebook' => 'https://fr-fr.facebook.com/AgenceBestTours',
                'instagram' => 'https://www.instagram.com/best_tours_tunisia',
                'whatapp' => 'https://wa.me/99748029/44848350'
            ])
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
