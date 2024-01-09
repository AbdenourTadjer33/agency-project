<x-app-layout>
    <x-slot:title>Voyage organisé - Best tour</x-slot:title>

    <div class="relative w-full h-96 overflow-hidden">
        <div class="w-full h-full bg-center bg-cover bg-no-repeat transition duration-200 hover:scale-110"
            style="background-image: linear-gradient(rgba(29, 29, 29, 0.5), rgba(29, 29, 29, 0.5)), url({{ asset('storage/images/world-tour.jpg') }})"></div>
        <div
            class="p-2 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl font-bold bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent capitalize">
            Nos Voyages oraganisé
        </div>
    </div>


    <div class="p-5">
        <div class="flex gap-10 justify-center flex-wrap">
            @foreach ($trips as $trip)
                @php
                    $assets = $trip->assets;
                    if (!is_array($assets)) {
                        $assets = json_decode($assets, true);
                    }
                @endphp
                <div
                    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:bg-gray-50">
                    <a href="{{ route('trip.show', ['slug' => $trip->slug]) }}" class="overflow-hidden">
                        <div class="w-full h-72 bg-center bg-cover bg-no-repeat rounded-t-lg transition duration-300 hover:scale-110"
                            style="background-image: url({{ asset('storage/' . $assets[0]['path']) }})"></div>
                    </a>
                    <div class="p-5 space-y-2">
                        <a href="{{ route('trip.show', ['slug' => $trip->slug]) }}">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white capitalize">
                                {{ $trip->name }}
                            </h5>
                        </a>
                        <address class="flex items-center text-base capitalize">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white me-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 21">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path
                                        d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                                </g>
                            </svg>
                            {{ $trip->destination . ', ' . $trip->city }}
                        </address>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.0"
                                class="w-5 h-5 text-gray-800 dark:text-white me-2" viewBox="0 0 512.000000 512.000000"
                                preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="currentColor" stroke="none">
                                    <path
                                        d="M45 4228 c-47 -25 -45 53 -45 -1666 0 -1020 4 -1630 10 -1641 5 -10 22 -24 39 -30 24 -10 34 -10 59 3 16 8 32 23 36 31 3 9 6 309 6 666 l0 649 90 0 90 0 -6 -80 c-8 -93 4 -134 44 -148 31 -11 69 0 87 25 7 9 15 59 19 112 13 179 55 333 133 481 198 376 553 613 976 650 65 6 127 15 138 20 24 13 35 55 23 89 -15 41 -48 51 -146 44 l-88 -6 0 92 0 91 285 0 285 0 0 -349 0 -349 -29 -11 c-67 -28 -116 -106 -127 -204 l-7 -55 -271 -4 -271 -4 -62 -28 c-64 -29 -128 -88 -156 -142 -35 -68 -38 -138 -35 -744 l3 -595 26 -55 c33 -70 89 -126 159 -159 l55 -26 1755 0 c1667 0 1757 1 1795 18 104 47 173 127 194 227 9 40 11 220 9 660 l-3 605 -24 53 c-29 65 -113 143 -178 167 -40 15 -93 19 -319 23 l-271 4 -6 57 c-2 32 -14 76 -26 98 -21 43 -95 113 -118 113 -10 0 -13 67 -13 350 l0 350 388 0 c387 0 387 0 438 24 104 48 156 166 122 277 -15 51 -69 114 -122 142 l-41 22 -2397 3 -2398 2 0 49 c0 64 -6 79 -41 96 -33 18 -38 18 -64 3z m4875 -311 c54 -27 64 -97 19 -135 -18 -15 -67 -17 -535 -22 l-516 -5 -19 -24 c-25 -31 -24 -69 3 -98 18 -19 32 -23 80 -23 l58 0 0 -344 0 -343 -49 -30 c-67 -42 -104 -107 -109 -190 l-4 -63 -729 0 -729 0 0 55 c0 91 -45 167 -121 206 l-39 20 2 342 3 342 702 5 c644 5 704 6 719 22 24 24 22 75 -5 101 l-22 22 -1739 3 -1740 2 0 85 0 85 2373 0 c1877 0 2377 -3 2397 -13z m-3560 -412 c0 -76 -4 -107 -12 -109 -268 -77 -445 -180 -628 -365 -166 -167 -265 -326 -333 -536 l-32 -100 -103 -3 -102 -3 0 611 0 610 605 0 605 0 0 -105z m839 -740 c33 -17 41 -33 41 -86 l0 -39 -85 0 c-83 0 -85 1 -85 24 0 41 21 86 49 101 33 18 46 18 80 0z m1945 -14 c10 -11 20 -39 23 -65 l6 -46 -87 0 -86 0 0 43 c1 44 12 66 45 85 26 16 75 7 99 -17z m746 -293 c18 -13 43 -36 54 -51 21 -28 21 -37 24 -634 2 -597 2 -606 -18 -649 -13 -26 -36 -53 -58 -66 l-37 -23 -1735 0 c-1629 0 -1738 1 -1762 17 -15 10 -39 34 -55 55 l-28 36 -3 601 -2 601 22 45 c13 25 38 55 57 67 l34 23 1737 0 1737 0 33 -22z" />
                                    <path
                                        d="M1650 2128 c-19 -21 -20 -33 -20 -366 0 -223 4 -350 11 -363 24 -46 105 -42 128 7 6 14 11 78 11 149 l0 125 125 0 125 0 0 -129 c0 -71 3 -137 6 -146 4 -8 19 -22 34 -30 36 -19 83 -4 99 31 7 17 11 130 11 358 0 322 -1 334 -21 360 -27 34 -77 36 -107 3 -20 -22 -22 -33 -22 -160 l0 -137 -125 0 -125 0 0 134 c0 120 -2 136 -21 160 -27 34 -79 36 -109 4z" />
                                    <path
                                        d="M2495 2137 c-88 -35 -153 -106 -176 -190 -6 -24 -9 -110 -7 -211 3 -159 5 -174 28 -219 47 -93 141 -151 245 -150 108 0 195 54 247 153 22 43 23 55 23 240 0 183 -1 198 -23 237 -29 54 -78 104 -128 128 -47 23 -166 30 -209 12z m173 -171 l37 -34 3 -161 c3 -149 2 -164 -17 -195 -21 -34 -73 -66 -106 -66 -33 0 -85 32 -106 66 -19 31 -20 46 -17 195 l3 161 37 34 c31 28 45 34 83 34 38 0 52 -6 83 -34z" />
                                    <path
                                        d="M2951 2124 c-24 -31 -26 -43 -10 -78 15 -32 56 -46 130 -46 l59 0 0 -285 c0 -191 4 -292 11 -309 16 -35 63 -50 99 -31 15 8 30 22 34 30 3 9 6 147 6 306 l0 289 59 0 c69 0 118 15 131 40 16 30 12 64 -10 88 -20 21 -27 22 -255 22 l-234 0 -20 -26z" />
                                    <path
                                        d="M3614 2129 c-18 -20 -19 -43 -22 -357 -2 -238 1 -344 9 -364 17 -42 60 -50 252 -46 163 3 169 4 188 27 26 32 24 73 -4 99 -22 20 -33 22 -160 22 l-137 0 0 84 0 84 101 4 c92 3 103 5 120 27 25 30 24 76 -1 101 -17 17 -33 20 -120 20 l-100 0 0 85 0 85 119 0 c125 0 175 11 191 40 16 30 12 68 -10 90 -19 19 -33 20 -213 20 -184 0 -195 -1 -213 -21z" />
                                    <path
                                        d="M4214 2129 c-18 -20 -19 -41 -19 -370 l0 -348 23 -23 c22 -22 28 -23 211 -23 172 0 191 2 210 19 25 22 28 73 7 102 -13 17 -31 20 -158 24 l-143 5 -5 303 c-5 286 -6 304 -24 318 -29 21 -80 18 -102 -7z" />
                                </g>
                            </svg>
                            {{ $trip->hotel->name }}
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                @for ($i = 0; $i < $trip->hotel->classification; $i++)
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                                @for ($i = 0; $i < 5 - $trip->hotel->classification; $i++)
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg dark:text-white capitalize">à partir de:
                                    <span class="font-bold">{{ $trip->pricing->price_adult . ' DA' }}</span>
                                </h4>
                            </div>
                            <a href="{{ route('trip.show', ['slug' => $trip->slug]) }}"
                                class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>