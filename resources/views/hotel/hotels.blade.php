<x-app-layout>
    <x-slot:title>Hôtel - Best tour</x-slot:title>

    <div class="relative w-full h-96 overflow-hidden">
        <div class="w-full h-full bg-center bg-cover bg-no-repeat transition duration-300 hover:scale-110"
            style="background-image: linear-gradient(rgba(29, 29, 29, 0.5), rgba(29, 29, 29, 0.5)), url({{ asset('storage/images/world-tour.jpg') }})"></div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl font-bold bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent capitalize">
            Nos Hôtels
        </div>
    </div>

    <div class="p-5 mt-4">
        <div class="flex gap-10 justify-center flex-wrap">
            @foreach ($hotels as $hotel)
                @php
                    $services = $hotel->services;
                    if (!is_array($services)) {
                        $services = json_decode($services, true);
                    }
                    $assets = $hotel->assets;
                    if (!is_array($assets)) {
                        $assets = json_decode($assets, true);
                    }
                @endphp
                <div
                    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:bg-gray-50">
                    <a href="{{ route('hotel.show', ['slug' => $hotel->slug]) }}">
                        <div class="w-full h-72 bg-center bg-cover bg-no-repeat rounded-t-lg transition duration-300 hover:scale-110"
                            style="background-image: url({{ asset('storage/' . $assets[0]['path']) }})"></div>
                    </a>
                    <div class="p-5 space-y-2">
                        <a href="{{ route('hotel.show', ['slug' => $hotel->slug]) }}">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $hotel->name }}
                            </h5>
                        </a>
                        <div class="flex items-center">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                @for ($i = 0; $i < $hotel->classification; $i++)
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                                @for ($i = 0; $i < 5 - $hotel->classification; $i++)
                                    <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <address class="flex items-center">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white me-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 21">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path
                                        d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                                </g>
                            </svg>
                            {{ $hotel->country . ', ' . $hotel->city }}
                        </address>
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg dark:text-white capitalize">à partir de:
                                    <span class="font-bold">{{ $hotel->pricing->price_adult . ' DA' }}</span>
                                </h4>
                            </div>
                            <a href="{{ route('hotel.show', ['slug' => $hotel->slug]) }}"
                                class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                voir
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
