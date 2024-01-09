<x-admin-layout>
    <x-slot:title>{{ $hotel->name }}</x-slot:title>
    <div>
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('status') }}</span>
            </div> </a>
        @endif

        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @php
            $services = $hotel->services;
            if (!is_array($hotel->services)) {
                $services = json_decode($hotel->services, true);
            }

            $coordinates = $hotel->coordinates;
            if (!is_array($hotel->coordinates)) {
                $coordinates = json_decode($hotel->coordinates, true);
            }

            $assets = $hotel->assets;
            if (!is_array($hotel->assets)) {
                $assets = json_decode($hotel->assets, true);
            }
        @endphp

        <div class="mt-2 text-gray-600">
            <div class="text-3xl font-bold">{{ $hotel->name }}</div>
            <div class="text-sm mt-1">Nombre de chambres : <span class="font-medium">{{ $hotel->number_rooms }}</span>
            </div>
            <div class="flex items-center text-sm mt-1">
                Classification : <span class="font-medium ms-2">{{ $hotel->classification }}</span>
                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
            </div>
            <div class="text-sm mt-1">Description : <span class="font-medium">{{ $hotel->description }}</span></div>
            <div class="text-sm mt-1">Adresse : <span
                    class="font-medium">{{ $hotel->address . ', ' . $hotel->city . ', ' . $hotel->country }}</span>
            </div>
            <div class="text-sm mt-1">N° tél : <span
                    class=" font-medium">{{ $coordinates['phone_code'] . ' ' . $coordinates['phone'] }}</span></div>
            <div class="text-sm mt-1">Email : <span class=" font-medium">{{ $coordinates['email'] }}</span></div>
            @if (!empty($coordinates['website']))
                <div class="text-sm mt-1">Site web : <a href="{{ $coordinates['website'] }}"
                        class=" font-medium underline text-blue-700">{{ $coordinates['website'] }}</a>
                </div>
            @endif
            @if (!empty($coordinates['facebook']))
                <div class="text-sm mt-1">Facebook : <a href="{{ $coordinates['facebook'] }}"
                        class=" font-medium underline text-blue-700">{{ $coordinates['facebook'] }}</a>
                </div>
            @endif
            @if (!empty($coordinates['instagram']))
                <div class="text-sm mt-1">Instagram : <a href="{{ $coordinates['instagram'] }}"
                        class="font-medium underline text-blue-700">{{ $coordinates['instagram'] }}</a>
                </div>
            @endif
            <div class="flex flex-wrap mt-2 select-none" id="tagButtons">
                @foreach ($services as $tag)
                    <span
                        class="bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300 inline-flex items-center cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
            <div class="mt-5">
                <div class="grid gap-4 w-1/2">
                    <div>
                        <img style="min-width: 100%" id="main-img" class="h-auto max-w-full rounded-lg" src="{{ asset('storage/' . $assets[0]['path']) }}">
                    </div>
                    <div class="grid grid-cols-{{ count($assets) }} gap-4">
                        @foreach ($assets as $asset)
                            <div>
                                <img class="h-auto max-w-full rounded-lg small-img" src="{{ asset('storage/' . $asset['path']) }}"
                                    alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let mainImg = document.querySelector("#main-img");
        let smallImgs = document.querySelectorAll(".small-img")


        smallImgs.forEach(img => {
            img.onclick = event => {
                mainImg.src = img.src;
            }    
        });
    </script>

</x-admin-layout>
