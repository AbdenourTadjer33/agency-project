<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Hotel;
use App\Models\Pricing;
use App\Models\Trip;
use App\Models\TripCategorie;
use App\Models\TripDate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Radisson Blu Hotel Heliopolis',
                'slug' => NULL,
                'description' => NULL,
                'country' => NULL,
                'city' => NULL,
                'address' => NULL,
                'classification' => 4,
                'number_rooms' => NULL,
                'services' => NULL,
                'assets' => NULL,
            ],
            [
                'name' => 'AZ HOTELS ZERALDA',
                'slug' => 'az-hotels-zeralda',
                'description' => "AZ Hotels Zeralda, né sous une bonne étoile en Décembre 2015 est un hôtel 4 étoiles de 133 Chambres , 4 restaurants , une salle des fêtes, salles de réunion, un spa, un salon de coiffure et boutiques parmi les plus réputés d’Alger. Le seul en son genre, ce qui en fait une adresse incontournable à Alger pour le tout Alger et pour tous ceux qui veulent goûter à la fois d’un certain Art de Vivre,d’une Expérience Inoubliable et profiter d’un cadre exceptionnel. Vous trouverez entre autre, un restaurant l’Entre Amis au décor contemporain, le restaurant Le Buffet aux saveurs internationales, Pasta Basta, restaurant Italien ouvert sur un Le Patio et un restaurant gastronomique Le Méditerranée dominant toute la ville de Zeralda aux mille lumières, un spa dédié au bien être, à la beauté et au confort.",
                'country' => 'Algeria',
                'city' => 'Alger',
                'address' => '09 Route de Mahalma 16065 Zéralda',
                'coordinates' => json_encode([
                    'phone_code' => '+213',
                    'phone' => '554 51 80 91',
                    'email' => 'reservation@azhotels.dz',
                ]),
                'classification' => 4,
                'number_rooms' => 133,
                'services' => json_encode([
                    "Wi-Fi gratuit",
                    "Service de chambre",
                    "Parking",
                    "Réception 24h/24",
                    "Climatisation",
                    "Restaurant",
                    "Salles de réunion",
                    "Blanchisserie",
                    "Jacuzzi",
                    "Accès handicapés",
                    "Service de bagagerie",
                    "Journaux gratuits",
                    "Service de repassage",
                    "Service de fax/photocopie",
                    "Vidéo-surveillance dans les espaces communs",
                    "Chambres non-fumeurs",
                    "Coffre-fort à la réception",
                    "Service de traiteur",
                    "Service d'étage 24h/24",
                ]),
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "hotels/Lnl62nvugEpiFIkoLSaHcVs4kBrJrTUSNAbUZQYp.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "hotels/Nq6hhPlgTGlFHldWhNEJxPK1hsp9uQBuRdlmfWZ4.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "hotels/ll5HfvU1g9Y4fBj09PGfkUI6uAYR7E1J6dEIVTX1.jpg",
                        "description" => null,
                    ],
                ]),
            ],
            [
                'name' => 'Hôtel Royal Victoria',
                'slug' => 'hotel-royal-victoria',
                'description' => "L'hôtel Royal Victoria est situé au cœur de l’activité économique, culturelle et gastronomique du capital de la Tunisie, l’Hôtel Royal Victoria vous réserve un accueil chaleureux et sympathique dans un décor original, récemment conçu et modernisé. Il offre l’avantage de la proximité immédiate de la Gare Centrale de Tunis, outre le site archéologique de Carthage (20 min), le musée du Bardo (20 min) le Port de La Goulette et l'aéroport Tunis-Carthage (15 min).\r\n\r\nRoyal Victoria est un véritable hôtel de charme au cachet spécial. Il offre 40 chambres et suites, avec un ameublement et un décor mauresque de haut de gamme, l’atmosphère est, à la fois, conviviale et branchée.\r\n\r\nEnvie d’histoire, de gastronomie ou de shopping, l’Hôtel ROYAL VICTORIA est l’endroit idéal pour combler vos désirs.\r\n\r\nL’Hôtel se situe en plein cœur de TUNIS, d’un côté, le centre-ville avec ces centres commerciaux et d’affaires et sa célèbre avenue marchande Habib Bourguiba et d’un autre côté, la médina avec ses rues piétonnes, ses monuments, ses bazars et ses restaurants gastronomiques.\r\n\r\nLes voyageurs d’affaires seront, également, comblés l’Hôtel Royal Victoria qui dispose d’une salle de réunion où l’on organise des banquets modernes. L’on propose aussi des forfaits-réunions et un programme corporatif des plus intéressants.",
                'country' => 'Tunisia',
                'city' => 'Tunisia',
                'address' => '5 Place de la Victoire Port de France',
                'coordinates' => json_encode([
                    "phone_code" => "+216",
                    "phone" => "71 320 066",
                    "email" => "resa@hotel-royalvictoria.com",
                    "website" => "https://hotel-royalvictoria.com",
                    "facebook" => null,
                    "instagram" => null,
                    "booking" => null,
                ]),
                'classification' => 3,
                'number_rooms' => 45,
                'services' => json_encode([
                    "Wi-Fi gratuit",
                    "Parking",
                    "Service de chambre",
                    "Réception 24h/24",
                    "Climatisation",
                    "Bar",
                    "Salles de réunion",
                    "Jacuzzi",
                    "Accès handicapés",
                    "Chambres non-fumeurs",
                    "Coffre-fort à la réception",
                    "Journaux gratuits",
                ]),
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "hotels/LYJ2I1u2uSMsLyKAJFh3LDIkyajrNHSgakd5Ae5G.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "hotels/P9BmttQ9FTUK79OFePaeXkFXlFyd1N6EVibm9viB.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "hotels/u74oGDUuIEowfNugjFny8dAUSmEj8DQXZMtOl0vH.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 4,
                        "path" => "hotels/ZeZWXxVcaNZNZUT7AQDaRe0NQyJPXZvtskP0eDqH.jpg",
                        "description" => null,
                    ],
                ]),
            ],
            [
                'name' => 'Hotel Da Vinci',
                'slug' => null,
                'description' => null,
                'country' => null,
                'city' => null,
                'address' => null,
                'coordinates' => null,
                'classification' => 5,
                'number_rooms' => null,
                'services' => null,
                'assets' => null,
            ],
            [
                'name' => 'Quinzerie hôtel',
                'slug' => 'quinzerie-hotel',
                'description' => "
                    Opened in 2022, The Quinzerie Hotel is a neighbourhood hotel par excellence. The Hotel brings to life the art of living, no stranger to its home: the 15th arrondissement district of Paris, and more precisely Saint-Charles village. Ideally suited for those who like to step off the beaten tourist track and explore unique places, The Quinzerie Hotel inhabits the spirit of its very Parisian surroundings.\r\n
                    \r\n
                    Behind its modern facade lies a number of private spaces, gardens, terraces and rooftops, all designed to enhance your stay. The Hotel's exclusive and contemporary atmosphere is paired with a compassionate team ready to attend to your every whim, defining The Hotel's savoir-être.
                    ",
                'country' => 'France',
                'city' => 'Paris',
                'address' => '40 rue de la Convention',
                'coordinates' => json_encode([
                    "phone_code" => "+93",
                    "phone" => "1 89 89 40 40",
                    "email" => "bonjour@quinzeriehotel.fr",
                    "website" => "https://www.quinzeriehotel.fr",
                    "facebook" => null,
                    "instagram" => "https://www.instagram.com/quinzeriehotel/",
                ]),
                'classification' => 4,
                'number_rooms' => 65,
                'services' => json_encode([
                    "Wi-Fi gratuit",
                    "Service de chambre",
                    "Réception 24h/24",
                    "Climatisation",
                    "Restaurant",
                    "Bar",
                    "Salle de fitness",
                    "Spa",
                    "Sauna",
                    "Jacuzzi",
                    "Accès handicapés",
                    "Journaux gratuits",
                    "Service de fax/photocopie",
                    "Chambres non-fumeurs",
                    "Coffre-fort à la réception",
                    "Service d'étage 24h/24",
                    "Service de traiteur",
                ]),
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "hotels/8VpyVhkas7IGfEdv9hyyMlzTFtQfymDd9bEoKMOa.jpg",
                        "originalName" => "517417803.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "hotels/lt5nK8x5tvBNDpaI1riSNSZvg4YWoE279Hkl8eNS.jpg",
                        "originalName" => "quinzerie-balcon-164468-1920-1080-auto.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "hotels/xIjFkEuLMHM5I2sbU4DhrGGtZj886pJpOXxzVgJj.jpg",
                        "originalName" => "quinzerie-chambre-164434-1920-1080-auto.jpeg",
                        "description" => null,
                    ],
                    [
                        "id" => 4,
                        "path" => "hotels/dvOL68ZhOThMAhBPChqbMpl8RnnRlg82uVvQigaV.jpg",
                        "originalName" => "quinzerie-fitness-164505-1920-1080-auto.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 5,
                        "path" => "hotels/i0dhTae24LCaRU33C1zcGsHOhkS22X4OZTLiYXPJ.jpg",
                        "originalName" => "quinzerie-hotel-164438-1920-1080-auto.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 6,
                        "path" => "hotels/nxWKHzRp8o2jca2PDv5qsxape7FOod9kz5We73qz.jpg",
                        "originalName" => "quinzerie-petit-dejeuner-164490-1920-1080-auto.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 7,
                        "path" => "hotels/hy50eyRZhNArekYVEat7iK7BXjTi5uJlck00JxH2.jpg",
                        "originalName" => "quinzerie-sauna-164458-1920-1080-auto.jpg",
                        "description" => null,
                    ],
                ]),
            ],
            [
                'name' => 'Voco Makkah Hotel',
                'slug' => null,
                'description' => null,
                'country' => null,
                'city' => null,
                'address' => null,
                'coordinates' => null,
                'classification' => 4,
                'number_rooms' => null,
                'assets' => null
            ],
            [
                'name' => 'Hôtel Dar Diaf Bouchaoui',
                'slug' => 'hotel-dar-diaf-bouchaoui',
                'description' => "
                    Situé dans un quartier résidentiel, cet hôtel simple se trouve à 6 km de la plage du Club des Pins et à 31 km de l'aéroport d'Alger-Houari-Boumédiène.\r\n
                    Les chambres sobres sont équipées d'une télévision à écran plat. Les suites disposent d'un espace de vie.\r\n
                    \r\n
                    L'établissement possède un restaurant buffet, un élégant salon d'accueil agrémenté d'une fontaine et un espace de conférence/réunion. L'espace spa comprend une piscine intérieure et un hammam. Des soins bien-être y sont proposés.
                ",
                'country' => 'Algeria',
                'city' => 'ALger',
                'address' => 'Domaine Hamza, Bouchaoui 3 Cheraga',
                'coordinates' => json_encode([
                    "phone_code" => "+213",
                    "phone" => "023 22 80 80",
                    "email" => "dar-diaf-bouchaoui@gmail.com",
                    "website" => null,
                    "facebook" => null,
                    "instagram" => null,
                ]),
                'classification' => 3,
                'number_rooms' => 60,
                'services' => json_encode([
                    "Wi-Fi gratuit",
                    "Parking",
                    "Service de chambre",
                    "Réception 24h/24",
                    "Climatisation",
                    "Restaurant",
                    "Salle de fitness",
                    "Piscine",
                    "Centre d'affaires",
                    "Salles de réunion",
                    "Blanchisserie",
                    "Service de conciergerie",
                    "Animaux de compagnie acceptés",
                    "Location de voitures",
                    "Spa",
                    "Sauna",
                    "Activités pour enfants",
                    "Accès handicapés",
                    "Boutiques",
                    "Service de bagagerie",
                    "Service de repassage",
                    "Journaux gratuits",
                    "Service de fax/photocopie",
                    "Salles de banquet",
                    "Photographie",
                    "Chambres non-fumeurs",
                    "Coffre-fort à la réception",
                    "Service de voiturier",
                    "Service de traiteur",
                    "Service de préparation de lit",
                    "Services de mariage",
                    "Service d'étage 24h/24",
                ]),
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "hotels/uz8HPcGGC0Vmr7K9jOWAmbqMV4GCUadMBBjIZrPF.jpg",
                        "originalName" => "a93f5522.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "hotels/lJNwWWmzVU2z2vjeWAeyjLgUITvwTh7AnoY0I89G.jpg",
                        "originalName" => "dar-diaf-bouchaoui.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "hotels/iYUzLslAO1o0DcDq9SXx8iDzJ8T467qGINLuV7U4.jpg",
                        "originalName" => "dar-diaf-bouchaoui (1).jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 4,
                        "path" => "hotels/YCNoEHo6Ft48tiIaSr90gGfDf91QTHX0FYsw16Nh.jpg",
                        "originalName" => "dar-diaf-bouchaoui (2).jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 5,
                        "path" => "hotels/1n7Z3SMUxAmBvJej7snxdJWh9fwk2xOzR2y4Mtol.jpg",
                        "originalName" => "dar-diaf-bouchaoui (3).jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 6,
                        "path" => "hotels/vRnVfsvSKt22sAdBDOG9Ht4IWkIEWoQvblpbBqcB.jpg",
                        "originalName" => "photo8jpg.jpg",
                        "description" => null,
                    ],
                ]),
            ],
            [
                'name' => 'Complexe Touristique Les Andalouses – Oran',
                'slug' => 'complexe-touristique-les-andalouses-oran',
                'description' => "Andalouses, premier grand centre touristique de l’ouest est l’un des plus beaux d’Algérie, situé sur la corniche ouest d’Oran. Il est distant de 25 Km de la ville d’Oran El Bahia et à 34 Km de l’Aéroport international d’Oran. Il est implanté sur une plage en sable dorée de 1200 m le long de la baie des corailleurs et au pied d’une montagne verdoyante. S’étendant au milieu d’un espace vert avantageusement boisé et fleuri et sur 20 Ha sont bâtis 175 bungalows, villas et 1 hôtel de 402 chambres avec annexes. Le complexe touristique les Andalouses propose á sa chère clientèle, des retrouvailles avec la nature, la mer, la pureté, á travers des excursions, des randonnées pédestres, des méharées, des bivouacs agrémentés de soirées folkloriques.",
                'country' => 'Algeria',
                'city' => 'Oran',
                'address' => 'Commune El Ançor',
                'coordinates' => json_encode([
                    "phone_code" => "+213",
                    "phone" => "770 60 68 01 /02",
                    "email" => "contact@andalouses.com",
                    "website" => null,
                    "facebook" => null,
                    "instagram" => null,
                ]),
                'classification' => 5,
                'number_rooms' => 400,
                'services' => json_encode([
                    "Wi-Fi gratuit",
                    "Parking",
                    "Service de change",
                    "Réception 24h/24",
                    "Service de chambre",
                    "Climatisation",
                    "Restaurant",
                    "Bar",
                    "Salle de fitness",
                    "Piscine",
                    "Navette aéroport",
                    "Centre d'affaires",
                    "Salles de réunion",
                    "Blanchisserie",
                    "Service de conciergerie",
                    "Service de bagagerie",
                    "Boutiques",
                    "Salon de coiffure",
                    "Accès handicapés",
                    "Activités pour enfants",
                    "Jacuzzi",
                    "Sauna",
                    "Spa",
                    "Animaux de compagnie acceptés",
                    "Service de repassage",
                    "Journaux gratuits",
                    "Service de fax/photocopie",
                    "Épicerie sur place",
                    "Garde d'enfants",
                    "Salle de jeux",
                    "Distributeur automatique de billets",
                    "Salles de banquet",
                    "Photographie",
                    "Vidéo-surveillance dans les espaces communs",
                    "Location de matériel de ski",
                    "Service de navette vers les attractions locales",
                    "Chambres non-fumeurs",
                    "Coffre-fort à la réception",
                    "Service de voiturier",
                    "Service de traiteur",
                    "Service de préparation de lit",
                    "Bureau d'excursions",
                    "Chaises hautes disponibles",
                    "Service d'étage 24h/24",
                ]),
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "hotels/GFItlT0vS7DPSqkIfkdkPYOGsDExtjQZAUnBg62B.jpg",
                        "originalName" => "271109244_340619674568831_8099396274574502016_n.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "hotels/RfqcFCqtZt4sPCrYlhEuPRtlimzrVR0WtB1g4ZqY.jpg",
                        "originalName" => "280959754_422002809763850_7168997509051342555_n.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "hotels/UvP0y2CVJoipgx3aBwMBxMpWFkpbfv1Mgr4WfCux.jpg",
                        "originalName" => "400689892_759827152826375_2635007909551185980_n.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 4,
                        "path" => "hotels/nEKgrw53iyjYiDizT5Nvr6vnTIs3nL4vK6i92f06.jpg",
                        "originalName" => "411961088_784446143697809_6941008310647266817_n.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 5,
                        "path" => "hotels/AD5IAsEwsWCN0VpkbYLS1ZqDAYJrlpOM5cZvOnLP.jpg",
                        "originalName" => "412005536_784446183697805_3589478159914763506_n.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 6,
                        "path" => "hotels/Iw1D024Lh8pKzL9opmXoYtMn0iwD2eKJAFfmQLhr.jpg",
                        "originalName" => "image-3-.jpg",
                        "description" => null,
                    ],
                ]),
            ],
            [
                'name' => '1siana hôtel',
                'slug' => null,
                'description' => null,
                'country' => null,
                'city' => null,
                'address' => null,
                'coordinates' => null,
                'classification' => 5,
                'number_rooms' => null,
                'services' => null,
                'assets' => null,
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }

        $tripCategory = [
            [
                'name' => 'spéciale vacances',
                'created_at' => '2023-12-30 02:41:34',
                'updated_at' => '2023-12-30 02:41:34',
            ],
            [
                'name' => 'Hadj',
                'created_at' => '2023-12-30 02:41:34',
                'updated_at' => '2023-12-30 02:41:34',
            ],
            [
                'name' => 'Omra',
                'created_at' => '2023-12-30 02:41:34',
                'updated_at' => '2023-12-30 02:41:34',
            ],
            [
                'name' => 'Voyage de noces',
                'created_at' => '2023-12-30 02:41:34',
                'updated_at' => '2023-12-30 02:41:34',
            ],
            [
                'name' => 'Aventure',
                'created_at' => '2023-12-30 02:41:34',
                'updated_at' => '2023-12-30 02:41:34',
            ],
            [
                'name' => 'Autre',
                'created_at' => '2023-12-30 02:41:34',
                'updated_at' => '2023-12-30 02:41:34',
            ],
        ];

        foreach ($tripCategory as $category) {
            TripCategorie::create($category);
        }

        $trips = [
            [
                'id' => 1,
                'name' => "HURGHADA & CAIRE",
                'slug' => 'obqi93nuxhnr1hwi-luxor-hurghada-caire',
                'description' => fake()->realTextBetween(),
                'destination' => 'Algeria',
                'city' => 'Alger',
                'formule_base' => 'LPD',
                'assets' => '[{"id":1,"path":"trips\/pyvGo3BmVwfnSyiXfUdMi0dAV0F4YEkYl2jkVokQ.jpg","originalName":"img.jpg","description":null}]',
                'trip_category_id' => 1,
                'hotel_id' => 1,
            ],
            [
                'id' => 2,
                'name' => "Italie la ville la plus inspirantes",
                'slug' => '9il8merqhc2nlasy-italie-la-ville-la-plus-inspirantes',
                'description' => "
                    Découvrez l'Italie au cours de ce tour de huit jours à travers la ville. Vous aurez l'occasion de connaître l'une des villes les plus romantiques et les plus inspirantes du monde. Profitez d'une visite à pied du centre historique de Naples avec notre guide local. Vous pourrez vous détendre en admirant les magnifiques vues de Positano et d'autres villages de pêcheurs pittoresques.\n
                    \n
                    Qu’est-ce qui est inclus?\n
                    \n
                    VISITE GUIDÉE :\n
                    Menée par des guides anglophones, francophones et hispanophones\n
                    \n
                    HÉBERGEMENT :\n
                    7 nuits d'hébergement\n
                    \n
                    REPAS :\n
                    7 petits déjeuners américains\n
                    2 déjeuners : 1 déjeuner comprend 1 eau minérale ou 1 boisson gazeuse et 1 déjeuner sans boissons\n
                    2 dîners (boissons non comprises)\n
                    \n
                    TRANSPORT :\n
                    Transport terrestre en autocar\n
                    Transfert d'arrivée depuis l'aéroport de Rome jusqu'à l'hôtel à Rome\n
                    Ferry Sorrente - Capri - Sorrente\n
                    \n
                    NON INCLUS :\n
                    Service de transport des bagages\n
                    Boissons\n
                    Frais d'entrée aux monuments ou musées lorsqu'ils ne sont pas explicitement mentionnés dans l'itinéraire\n
                    Taxes de séjour par nuit payables sur place (selon le règlement de chaque mairie)\n
                    Transfert de départ depuis l'hôtel vers les aéroports de Rome ou la gare centrale Termini\n
                    Tout ce qui n'est pas mentionné dans la section Inclus 
                ",
                'destination' => 'Italy',
                'city' => 'milano',
                'formule_base' => 'LPC',
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "trips/TeABwaw9f86zmRQgMyMIqly4N1mXAO4H11SvgWY0.jpg",
                        "originalName" => "40730553.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "trips/5AyS8ySxM1WdbSS0BTNvrNz07ODIjeiJckQbfHQr.jpg",
                        "originalName" => "Da_Vinci_Milano-Mailand-Doppelzimmer_Komfort-5278.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "trips/0d9ayOCQFwRuVZhueBRDGhVgNyMLiw6gevJw2o9E.jpg",
                        "originalName" => "hotel-da-vinci.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 4,
                        "path" => "trips/0FGGXLuf0mjlcFpXEiN91n6OFmgefKAiR3eW6Pdg.png",
                        "originalName" => "IO_1_1.png",
                        "description" => null,
                    ],
                    [
                        "id" => 5,
                        "path" => "trips/Skfx8sgAUADRqYNUfyOQZmfOtLHclvFwqt4nRYGq.png",
                        "originalName" => "_JPO_1.png",
                        "description" => null,
                    ],
                    [
                        "id" => 6,
                        "path" => "trips/7Zb6DJctTtD93kfG1ELYWkorOj0DtPATtMkqvVuk.png",
                        "originalName" => "UGIO_1.png",
                        "description" => null,
                    ],
                ]),
                'trip_category_id' => 1,
                'hotel_id' => 4,
            ],
            [
                'id' => 3,
                'name' => "Omra Janvier 2024",
                'slug' => 'ymnvtghpzvvrpc2l-omra-janvier-2024',
                'description' => "
                    Le Voco Makkah Hotel est situé à 1.5km du Haram. Tous les logements sont équipés de la climatisation, d’une télévision par satellite à écran plat, d’une bouilloire, d’une douche, d’un sèche-cheveux et d’une armoire. Cet hôtel 5 étoiles vous propose une connexion Wi-Fi gratuite dans l’ensemble des locaux et une réception ouverte 24h/24 . Des services de navette et d’étage sont également disponibles.\r\n
                    \r\n
                    Vol régulier avec Saudi ailines.\r\n
                    Accueil par notre correspondant local Saoudien.\r\n
                    Transfert Médine/La Mecque et La Mecque/Jeddah en bus climatisé.\r\n
                    Logement dans Grand Al Safi Hotel à Médine et Voco Makkah Hotel 5* à la Mecque.\r\n
                    Visites religieuses incluses.\r\n
                    Visa Touristique non inclus .\r\n
                    Supplément 150€ pour un visa.
                ",
                'destination' => 'Saudi Arabia',
                'city' => 'Makkah',
                'formule_base' => 'LPD',
                'assets' => json_encode([
                    [
                        "id" => 1,
                        "path" => "trips/6mLSMNUTT7x2AtSw0o1xiwh75dhCZIfAckUM96cs.jpg",
                        "originalName" => "1_ifrPVZVzm1vh-4iUrB3dFw.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 2,
                        "path" => "trips/751YUWZSIQ9KWO1xWUBl7vrQ3rWotVhuM4ej0bWL.jpg",
                        "originalName" => "GRAND SAFI HOTEL 01.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 3,
                        "path" => "trips/U4shrMCFR296BAVdjva0SmOyDZt2SNerutPoJqj2.jpg",
                        "originalName" => "HOTEL VOCO CH1.jpg",
                        "description" => null,
                    ],
                    [
                        "id" => 4,
                        "path" => "trips/kyNpmopYweUDyCpY2ZBKqiu1ZXjVyO8eDZHJv6Kz.jpg",
                        "originalName" => "HOTEL VOCO MAKKAH.jpg",
                        "description" => null,
                    ],
                ]),
                'trip_category_id' => 3,
                'hotel_id' => 6,
            ],
            [
                'id' => 4,
                'name' => "Voyage organisé DUBAI 2024",
                'slug' => '6oameucudj0ntpln-voyage-organise-dubai-2024',
                'description' => "
                    Best tour travel vous propose un Voyage Organisé DUBAI pour Pour 07 nuitées 08 jours\r\n
                    A L'HOTEL ASIANA 5étoiles / ⭐️⭐️⭐️⭐️ à 199 000 DA\r\n
                    \r\n
                    ✅✅ Inclut dans le programme :??\r\n
                    ? Billet d'avion ALGER- DUBAI-ALGER avec Fly Emirates\r\n
                    ? Hébergement à l’hôtel ASIANA 5étoiles ⭐️⭐️⭐️⭐️ avec petit déjeuner ??? ☕️ .\r\n
                    ? Visa pour Dubaï.\r\n
                    ? Transfert entre ? l'aéroport - Hôtel – Aéroport ?.\r\n
                    ? ‍ Un guide professionnel arabophone durant tout le séjour.\r\n
                    \r\n
                    Nos excursions :\r\n
                    DUBAI CITY TOUR : Burj Khalifa , Burj Arabe , Dubaï Mall , Dubaï Marina , Jumeira Beach , Palm Atlantis Madinat Jumeira .
                ",
                'destination' => 'United Arab Emirates',
                'city' => 'Dubai',
                'formule_base' => 'LPD',
                'assets' => json_encode(
                    [
                        [
                            "id" => 1,
                            "path" => "trips/X37r0YMDQAUWuKZ3GBcomyogTFTODEaQlkbikENp.png",
                            "originalName" => "1.png",
                            "description" => null,
                        ],
                        [
                            "id" => 2,
                            "path" => "trips/WpqIBU49qz75d9wVVUcIz28kk9MNqeZB9anubiUg.jpg",
                            "originalName" => "96617129.jpg",
                            "description" => null,
                        ],
                        [
                            "id" => 3,
                            "path" => "trips/yfVfaDIsgQ2al8KnljeVJi3UJ2mSml90X9chvvDd.jpg",
                            "originalName" => "Als-Expat-in-Dubai-Alle-unsere-Tipps-fur-eine-erfolgreiche-Auswanderung-1568x1046.jpg",
                            "description" => null,
                        ],
                        [
                            "id" => 4,
                            "path" => "trips/SXKKzs1LsRQmXRbUTFZBt36VH515Fgl00fEtKy7S.jpg",
                            "originalName" => "Asiana-Hotel-Dubai-Exterior.jpeg",
                            "description" => null,
                        ],
                        [
                            "id" => 5,
                            "path" => "trips/B2prz6ITqX4xHtGwzi2EWiMCg1SvgkXRygNh4ctg.jpg",
                            "originalName" => "L4E10158A1W1600H1066.jpg",
                            "description" => null,
                        ],
                    ]
                ),
                'trip_category_id' => 3,
                'hotel_id' => 1,
            ],
        ];

        foreach ($trips as $trip) {
            Trip::create($trip);
        }

        $tripDates = [
            [
                'id' => 1,
                'trip_id' => 1,
                'date_departure' => '2023-12-20',
                'date_return' => '2024-01-06',
            ],
            [
                'id' => 2,
                'trip_id' => 1,
                'date_departure' => '2024-01-10',
                'date_return' => '2024-01-18',
            ],
            [
                'id' => 3,
                'trip_id' => 1,
                'date_departure' => '2024-01-20',
                'date_return' => '2024-01-28',
            ],
            [
                'id' => 4,
                'trip_id' => 2,
                'date_departure' => '2024-02-01',
                'date_return' => '2024-02-09',
            ],
            [
                'id' => 5,
                'trip_id' => 2,
                'date_departure' => '2024-02-14',
                'date_return' => '2024-02-22',
            ],
            [
                'id' => 6,
                'trip_id' => 2,
                'date_departure' => '2024-02-28',
                'date_return' => '2024-03-07',
            ],
            [
                'id' => 7,
                'trip_id' => 3,
                'date_departure' => '2024-01-17',
                'date_return' => '2024-01-27',
            ],
            [
                'id' => 8,
                'trip_id' => 4,
                'date_departure' => '2024-01-25',
                'date_return' => '2024-02-01',
            ],
            [
                'id' => 9,
                'trip_id' => 4,
                'date_departure' => '2024-02-08',
                'date_return' => '2024-02-15',
            ],
            [
                'id' => 10,
                'trip_id' => 4,
                'date_departure' => '2024-02-22',
                'date_return' => '2024-02-29',
            ],
            [
                'id' => 11,
                'trip_id' => 4,
                'date_departure' => '2024-02-29',
                'date_return' => '2024-03-07',
            ],
        ];
        foreach ($tripDates as $date) {
            TripDate::create($date);
        }

        Pricing::insert([
            [
                'id' => 1,
                'pricingable_type' => 'App\\Models\\Trip',
                'pricingable_id' => 1,
                'price_adult' => 50000.00,
                'price_child' => 25000.00,
                'price_baby' => 15000.00,
                'price_lpd' => null,
                'price_ldp' => null,
                'price_lpc' => null,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 2,
                'pricingable_type' => 'App\\Models\\Hotel',
                'pricingable_id' => 2,
                'price_adult' => 9000.00,
                'price_child' => 5000.00,
                'price_baby' => 2000.00,
                'price_lpd' => 0,
                'price_ldp' => 2500,
                'price_lpc' => 5900,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 3,
                'pricingable_type' => 'App\\Models\\Hotel',
                'pricingable_id' => 3,
                'price_adult' => 8200.00,
                'price_child' => 4400.00,
                'price_baby' => 2000.00,
                'price_lpd' => 0,
                'price_ldp' => 3000,
                'price_lpc' => 6000,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 4,
                'pricingable_type' => 'App\\Models\\Trip',
                'pricingable_id' => 2,
                'price_adult' => 130000.00,
                'price_child' => 70000.00,
                'price_baby' => 15000.00,
                'price_lpd' => null,
                'price_ldp' => null,
                'price_lpc' => null,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 5,
                'pricingable_type' => 'App\\Models\\Hotel',
                'pricingable_id' => 5,
                'price_adult' => 22400.00,
                'price_child' => 15000.00,
                'price_baby' => 5000.00,
                'price_lpd' => 0,
                'price_ldp' => 10000,
                'price_lpc' => 20000,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 6,
                'pricingable_type' => 'App\\Models\\Trip',
                'pricingable_id' => 3,
                'price_adult' => 229000.00,
                'price_child' => 130000.00,
                'price_baby' => 50000.00,
                'price_lpd' => null,
                'price_ldp' => null,
                'price_lpc' => null,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 7,
                'pricingable_type' => 'App\\Models\\Hotel',
                'pricingable_id' => 7,
                'price_adult' => 6000.00,
                'price_child' => 4180.00,
                'price_baby' => 2000.00,
                'price_lpd' => 0,
                'price_ldp' => 3000,
                'price_lpc' => 5000,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 8,
                'pricingable_type' => 'App\\Models\\Hotel',
                'pricingable_id' => 8,
                'price_adult' => 8000.00,
                'price_child' => 5000.00,
                'price_baby' => 1990.00,
                'price_lpd' => 0,
                'price_ldp' => 5000,
                'price_lpc' => 10000,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ],
            [
                'id' => 9,
                'pricingable_type' => 'App\\Models\\Trip',
                'pricingable_id' => 4,
                'price_adult' => 199000.00,
                'price_child' => 139000.00,
                'price_baby' => 38000.00,
                'price_lpd' => null,
                'price_ldp' => null,
                'price_lpc' => null,
                'price_single' => null,
                'price_double' => null,
                'price_triple' => null,
                'price_quadruple' => null,
            ]
        ]);


        // \App\Models\User::factory(100)->create();
        // \App\Models\Hotel::factory(100)->create();
        // case of ticketing book
        // $bookings = \App\Models\Booking::factory(200)->create();
        // foreach ($bookings as $booking) {
        //     DB::table('booking_ticketings')->insert([
        //         'booking_id' => $booking->id,
        //         'flight_type' => 'AR',
        //         'airport_departure' => fake()->city(),
        //         'airport_arrived' => fake()->city(),
        //         'compagnie' => 'air algérie',
        //         'class' => "Pas de préférence",
        //     ]);
        // }

        // $bookings = \App\Models\Booking::factory(200)->create();
        // foreach ($bookings as $booking) {
        //     DB::table('booking_trips')->insert([
        //         'booking_id' => $booking->id,
        //         'formule' => 'LPD',
        //     ]);
        // }
    }
}
