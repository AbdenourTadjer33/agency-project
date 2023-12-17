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
        Schema::create('agency_coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained();
            $table->string('name', 30)->unique();
            $table->json('coordinates');
            $table->string('address', 64)->unique();
            $table->string('city', 64);
            $table->string('country', 64);
            $table->timestamps();
        });

        DB::table('agency_coordinates')->insert([
            [
                'id' => 1,
                'agency_id' => 1,
                'name' => 'Siége Social',
                'coordinates' =>  json_encode([
                    'phone' => '+213 770638523',
                    'email' => 'contact@best-tour.dz'
                ]),
                'address' => '67 rue mohemed mez cheraga',
                'city' => 'Alger',
                'country' => 'Algérie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'agency_id' => 1,
                'name' => 'Agence Hydra',
                'coordinates' => json_encode([
                    'phone' => '+213 550638753',
                    'email' => 'commercial-hydra@best-tour.dz'
                ]), 
                'address' => 'Bte 05 etage 20 124 Hydra',
                'city' => 'Alger',
                'country' => 'Algérie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'agency_id' => 1,
                'name' => 'Agence Oran',
                'coordinates' => json_encode([
                    'phone' => '+213 780115527',
                    'email' => 'commercial-oran@best-tour.dz',
                ]),
                'address' => '24 bd Didouche Mourad Plateau, 31000',
                'city' => 'Oran',
                'country' => 'Algérie',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_coordinates');
    }
};
