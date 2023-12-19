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


        // DB::table('hotels')->insert([
        //     [
        //         'id' => 1,
        //         'name' => 'Le Palais Gallien Hôtel & Spa',
        //         'slug' => 'le-palais-gallien-hotel-spa',
        //         'description' => "Situé à Bordeaux, à 1,1 km du musée d'art contemporain CAPC, l'établissement Le Palais Gallien Hôtel & Spa propose des hébergements avec une piscine extérieure ouverte en saison, un jardin, une terrasse et un parking privé. L'établissement dispose d'un bar et d'un restaurant servant une cuisine française. Vous pourrez profiter d'une réception ouverte 24h/24, de transferts aéroport et d'un service d\'étage. Une connexion Wi-Fi est disponible gratuitement dans l'ensemble de l'établissement.\r\n\r\nLes logements climatisés disposent d'un coin salon, d'un coffre-fort et d'une télévision par satellite à écran plat. La salle de bains privative inclut une douche, un sèche-cheveux et des articles de toilette gratuits. Les chambres disposent d'une machine à café. Certaines chambres possèdent une cuisine avec un réfrigérateur, un four et un lave-vaisselle. Toutes les chambres sont dotées d'un bureau et d'une bouilloire.",
        //         'coordinates' => json_encode(['phone' => '+33 99239422', 'email' => 'contact@palais-gallien.fr']),
        //         'classification' => 5,
        //         'number_rooms' => '50',
        //         'services' => json_encode([]),
        //         'address' => '144 Rue Abbé de l\'Epée, Centre de Bordeaux',
        //         'city' => 'Bordeaux',
        //         'country' => 'France',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'AZ HOTELS ZERALDA',
        //         'slug' => 'az-hotels-zeralda',
        //         'description' => "AZ Hotels Zeralda, né sous une bonne étoile en Décembre 2015 est un hôtel 4 étoiles de 133 Chambres , 4 restaurants , une salle des fêtes, salles de réunion, un spa, un salon de coiffure et boutiques parmi les plus réputés d’Alger. Le seul en son genre, ce qui en fait une adresse incontournable à Alger pour le tout Alger et pour tous ceux qui veulent goûter à la fois d’un certain Art de Vivre,d’une Expérience Inoubliable et profiter d’un cadre exceptionnel. Vous trouverez entre autre, un restaurant l’Entre Amis au décor contemporain, le restaurant Le Buffet aux saveurs internationales, Pasta Basta, restaurant Italien ouvert sur un Le Patio et un restaurant gastronomique Le Méditerranée dominant toute la ville de Zeralda aux mille lumières, un spa dédié au bien être, à la beauté et au confort.", 
        //         'coordinates' => json_encode(['phone' => '+213554 51 80 91', 'email' => 'reservation@azhotels.dz']),
        //         'classification' => 4,
        //         'number_rooms' => 133,
        //         'services' => json_encode([]),
        //         'address' => '09 Route de Mahalma 16065 Zéralda',
        //         'city' => 'Alger',
        //         'country' => 'Algeria',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Solymar Beach',
        //         'slug' => 'solymar-beach',
        //         'description' => "Solymar Beach est un hôtel  situé au bord de la plage de Soliman offrant aux touristes la détente, le confort, le service, l’animation, les activités sportives et le loisir.\r\n\r\nLa Tunisie est un site idéal pour profiter au mieux de vos vacances.\r\n\r\nL’excellence est une tradition dans notre hôtel qui se perpétue avec style et raffinement, afin de satisfaire le plus parfaitement possible les besoins de notre clientèle", 
        //         'coordinates' => json_encode(['phone' => '+93 72 379 605', 'email' => 'solymar@planet.tn']),
        //         'classification' => 3,
        //         'number_rooms' => '200',
        //         'services' => json_encode([]), 
        //         'address' => 'Plage Ejjehmi, Soliman 8020',
        //         'city' => 'Nabeul',
        //         'country' => 'Tunisia',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
