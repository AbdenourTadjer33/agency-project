<x-admin-layout>
    <x-slot:title>Gestion d'hôtel</x-slot:title>
    @if (session('status'))
        <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif
    <div>
        {{-- filter --}}
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>

            <!-- create button -->
            <a href="{{ route('admin.hotel.create') }}">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Créer un nouveau hôtel
                 </button>
            </a>
        </div>

        {{-- table --}}
        <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Hôtel
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Classification
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Chambres
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Coordonnées
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Adresse
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Prix
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Créer_à
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Modifié_à
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Opération
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($hotels as $hotel)
                        @if ($hotel->slug)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                {{-- name --}}
                                <th scope="row"
                                    class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="underline" target="_blank"
                                        href="{{ route('hotel.show', ['slug' => $hotel->slug]) }}">
                                        {{ $hotel->name }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M137.54,186.36a8,8,0,0,1,0,11.31l-9.94,10A56,56,0,0,1,48.38,128.4L72.5,104.28A56,56,0,0,1,149.31,102a8,8,0,1,1-10.64,12,40,40,0,0,0-54.85,1.63L59.7,139.72a40,40,0,0,0,56.58,56.58l9.94-9.94A8,8,0,0,1,137.54,186.36Zm70.08-138a56.08,56.08,0,0,0-79.22,0l-9.94,9.95a8,8,0,0,0,11.32,11.31l9.94-9.94a40,40,0,0,1,56.58,56.58L172.18,140.4A40,40,0,0,1,117.33,142,8,8,0,1,0,106.69,154a56,56,0,0,0,76.81-2.26l24.12-24.12A56.08,56.08,0,0,0,207.62,48.38Z">
                                            </path>
                                        </svg>
                                    </a>
                                </th>

                                {{-- description --}}
                                <td class="px-2 py-4">
                                    <span class="field" data-all="{{ $hotel->description }}"
                                        data-less="{{ Str::limit($hotel->description, 20) }}">{{ Str::limit($hotel->description, 20) }}</span>

                                    <span onclick="showMore(event)"
                                        class="more select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Plus
                                    </span>
                                    <span onclick="showLess(event)"
                                        class="less hidden select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Moins
                                    </span>
                                </td>

                                {{-- classification --}}
                                <td class="px-2 py-4">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= $hotel->classification; $i++)
                                            <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        @endfor
                                        @if ($hotel->classification != 5)
                                            @for ($i = 1; $i <= 5 - $hotel->classification; $i++)
                                                <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            @endfor
                                        @endif
                                    </div>

                                </td>

                                {{-- number of rooms --}}
                                <td class="px-2 py-4">
                                    {{ $hotel->number_rooms }}
                                </td>

                                {{-- coordinates --}}
                                <td class="px-2 py-4">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z">
                                            </path>
                                        </svg>
                                        <span class="font-medium">{{ $hotel->coordinates['email'] }}</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                                            </path>
                                        </svg>
                                        <span class="font-medium">
                                            {{ $hotel->coordinates['phone'] }}</span>
                                    </div>
                                </td>

                                {{-- address --}}
                                <td class="px-2 py-4">
                                    @php
                                        $address = $hotel->address . ', ' . ucfirst($hotel->city) . ' ' . ucfirst($hotel->country);
                                    @endphp
                                    <span class="field" data-all="{{ $address }}"
                                        data-less="{{ Str::limit($address, 15) }}">{{ Str::limit($address, 15) }}</span>
                                    {{-- <span class="block">{{ ucfirst($hotel->city) . ' ' . ucfirst($hotel->country) }}</span> --}}

                                    <span onclick="showMore(event)"
                                        class="more select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Plus
                                    </span>
                                    <span onclick="showLess(event)"
                                        class="less hidden select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Moins
                                    </span>
                                </td>

                                {{-- prices --}}
                                <td class="px-2 py-4">
                                    <span class="block">Adult: {{ $hotel->pricing->price_adult }} DA</span>
                                    <span class="block">enfant: {{ $hotel->pricing->price_child }} DA</span>
                                    <span class="block">bébe: {{ $hotel->pricing->price_baby }} DA</span>
                                </td>

                                {{-- created_at --}}
                                <td class="px-2 py-4">
                                    {{ $hotel->created_at }}
                                </td>

                                {{-- updated at --}}
                                <td class="px-2 py-4">
                                    {{ $hotel->updated_at == $hotel->created_at ? '' : $hotel->created_at }}
                                </td>

                                {{-- operations --}}
                                <td class="px-2 py-6 inline-flex gap-1">
                                    {{-- services btn --}}
                                    <button data-modal-target="services-modal-{{ $hotel->id }}"
                                        data-modal-toggle="services-modal-{{ $hotel->id }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-blue-400"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m14.6 21.3c-.3.226-.619.464-.89.7h2.29a1 1 0 0 1 0 2h-4a1 1 0 0 1 -1-1c0-1.5 1.275-2.456 2.4-3.3.75-.562 1.6-1.2 1.6-1.7a1 1 0 0 0 -2 0 1 1 0 0 1 -2 0 3 3 0 0 1 6 0c0 1.5-1.275 2.456-2.4 3.3zm8.4-6.3a1 1 0 0 0 -1 1v3h-1a1 1 0 0 1 -1-1v-2a1 1 0 0 0 -2 0v2a3 3 0 0 0 3 3h1v2a1 1 0 0 0 2 0v-7a1 1 0 0 0 -1-1zm-10-3v-5a1 1 0 0 0 -2 0v4h-3a1 1 0 0 0 0 2h4a1 1 0 0 0 1-1zm10-10a1 1 0 0 0 -1 1v2.374a12 12 0 1 0 -14.364 17.808 1.015 1.015 0 0 0 .364.068 1 1 0 0 0 .364-1.932 10 10 0 1 1 12.272-14.318h-2.636a1 1 0 0 0 0 2h3a3 3 0 0 0 3-3v-3a1 1 0 0 0 -1-1z" />
                                        </svg>
                                    </button>

                                    {{-- services modal --}}
                                    <div id="services-modal-{{ $hotel->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="services-modal-{{ $hotel->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-4 md:p-5">
                                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                                        Service
                                                        proposé par ce hôtel</h3>
                                                    <div
                                                        class="flex justify-between mb-1 text-gray-500 dark:text-gray-400">
                                                        {{-- my content --}}
                                                        <div class="flex flex-wrap">
                                                            @foreach ($hotel->services as $service)
                                                                <span
                                                                    class="bg-indigo-100 text-indigo-800 text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                                                    {{ $service }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="flex items-center mt-6 space-x-2 rtl:space-x-reverse">

                                                        <button data-modal-hide="services-modal-{{ $hotel->id }}"
                                                            type="button"
                                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit button -->
                                    <button
                                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-2 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                                        type="button">
                                        <a href="{{ route('admin.hotel.edit', ['id' => $hotel->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.0"
                                                class="w-4 text-purple-200" fill="currentColor"
                                                viewBox="0 0 512.000000 512.000000">
                                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                                    stroke="none">
                                                    <path
                                                        d="M4168 4811 c-31 -10 -79 -31 -105 -46 -66 -38 -1709 -1678 -1723 -1720 -23 -71 -140 -652 -140 -694 0 -86 64 -151 150 -151 42 0 624 118 695 140 20 7 308 288 867 847 910 912 878 876 913 1025 60 256 -92 521 -343 598 -85 26 -233 27 -314 1z m230 -306 c103 -44 150 -161 102 -259 -11 -23 -62 -84 -115 -136 l-95 -95 -137 138 -138 137 95 95 c52 53 113 104 135 115 48 24 102 26 153 5z m-468 -580 l135 -135 -580 -579 -580 -578 -163 -33 c-89 -18 -165 -30 -169 -27 -3 4 9 80 27 169 l33 163 576 578 c317 317 578 577 581 577 3 0 66 -61 140 -135z" />
                                                    <path
                                                        d="M1025 4723 c-261 -36 -502 -222 -604 -466 -65 -157 -62 -77 -59 -1732 3 -1402 4 -1504 21 -1560 22 -74 76 -191 116 -248 73 -107 211 -218 336 -270 145 -60 64 -58 1730 -55 l1520 3 80 28 c254 90 436 278 511 532 17 56 19 137 21 1176 l3 1115 -22 34 c-39 56 -72 75 -136 75 -70 0 -115 -28 -143 -89 -18 -39 -19 -89 -19 -1107 0 -1032 -1 -1069 -20 -1130 -38 -124 -119 -217 -239 -277 l-75 -37 -1490 -3 c-1342 -2 -1495 -1 -1545 14 -154 44 -276 168 -315 319 -14 52 -16 231 -16 1507 0 1034 3 1462 11 1500 32 150 136 269 288 330 l56 23 1112 5 c1103 5 1112 5 1139 26 52 39 69 71 69 133 0 47 -5 64 -27 93 -56 73 28 68 -1185 67 -598 -1 -1101 -4 -1118 -6z" />
                                                </g>
                                            </svg>
                                        </a>
                                    </button>

                                    {{-- Delete button --}}
                                    <button data-modal-target="delete-hotel-modal-{{ $hotel->id }}"
                                        data-modal-toggle="delete-hotel-modal-{{ $hotel->id }}"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-red-400"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                            </path>
                                        </svg>
                                    </button>

                                    {{-- Delete modal --}}
                                    <div id="delete-hotel-modal-{{ $hotel->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="delete-hotel-modal-{{ $hotel->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3
                                                        class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                        Êtes-vous sûr de vouloir supprimer
                                                        <span
                                                            class="text-black font-medium">{{ $hotel->name }}</span>?
                                                    </h3>
                                                    <div class="flex gap-1 justify-center items-center">
                                                        <form method="post"
                                                            action="{{ route('admin.hotel.delete', ['id' => $hotel->id]) }}">
                                                            @csrf @method('delete')
                                                            <button
                                                                data-modal-hide="delete-hotel-modal-{{ $hotel->id }}"
                                                                type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button
                                                            data-modal-hide="delete-hotel-modal-{{ $hotel->id }}"
                                                            type="button"
                                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                            Non, annuler
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function showMore(event) {
            const parentNode = event.target.parentNode;
            const descriptionEl = parentNode.querySelector('.field');
            const allDescription = descriptionEl.getAttribute('data-all');

            event.target.classList.add('hidden');
            descriptionEl.innerText = allDescription;

            parentNode.querySelector('.less').classList.remove('hidden')
        }

        function showLess(event) {
            const parentNode = event.target.parentNode;
            const descriptionEl = parentNode.querySelector('.field');
            const description = descriptionEl.getAttribute('data-less');

            event.target.classList.add('hidden');
            descriptionEl.innerText = description;

            parentNode.querySelector('.more').classList.remove('hidden')
        }
    </script>
</x-admin-layout>
