<x-admin-layout>
    <x-slot:title>Gestion d'hôtel</x-slot:title>
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

        {{-- filter --}}
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between mt-2">
            {{-- filter dropdown --}}
            <div class="flex items-center justify-center">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown" data-dropdown-placement="right-end"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="button">
                    Filter les résultats
                    <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="hidden w-72 z-50 p-3 bg-white rounded-lg shadow-xl dark:bg-gray-700">
                    <h1 class="mb-2 text-base font-semibold text-gray-600">Filter</h1>
                    <form action="{{ route('admin.trips') }}" method="get">
                        {{-- date de creation --}}
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="order_by" value="oldest"
                                    {{ request()->order_by == 'oldest' ? 'checked' : '' }} class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    les plus anciens
                                </span>
                            </label>
                        </div>
                        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                        {{-- pagination --}}
                        <div x-data="{ pagination: {{ request()->pagination ?? 6 }} }">
                            <h6 class="mb-1 text-sm font-medium text-gray-700">
                                Pagination : <span x-text="pagination"></span>
                            </h6>
                            <input id="labels-range-input" type="range" value="{{ request()->pagination ?? 6 }}"
                                min="5" max="15" x-on:change="pagination =  $el.value" name="pagination"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        </div>
                        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- options --}}
            <div class="flex gap-2 items-center">
                <a href="{{ route('admin.hotel.create') }}">
                    <button
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Créer un nouveau hôtel
                    </button>
                </a>
            </div>
        </div>
        @if (count($hotels))
            <div class="mt-4 flex flex-wrap gap-2">
                <div class="w-full max-w-full mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl bg-slate-850 shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div class="flex items-center h-full">
                                        <p
                                            class="mb-0 font-sans font-semibold leading-normal uppercase opacity-60 text-sm">
                                            Totale :
                                            {{ $hotels->total() . ' hôtel' }}{{ $hotels->total() > 1 ? 's' : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                        <i class="ni ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                        @php
                            $coordinates = $hotel->coordinates;
                            if (!is_array($coordinates)) {
                                $coordinates = json_decode($coordinates, true);
                            }
                            $services = $hotel->services;
                            if (!is_array($services)) {
                                $services = json_decode($services, true);
                            }
                            $assets = $hotel->assets;
                            if (!is_array($hotel->assets)) {
                                $assets = json_decode($hotel->assets, true);
                            }
                        @endphp
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block"
                                            fill="#000000" viewBox="0 0 256 256">
                                            <path
                                                d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z">
                                            </path>
                                        </svg>
                                        <span class="font-medium">{{ $coordinates['email'] }}</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block"
                                            fill="#000000" viewBox="0 0 256 256">
                                            <path
                                                d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                                            </path>
                                        </svg>
                                        <span class="font-medium">
                                            {{ $coordinates['phone'] }}</span>
                                    </div>
                                </td>

                                {{-- address --}}
                                <td class="px-2 py-4">
                                    @php
                                        $address = $hotel->address . ', ' . ucfirst($hotel->city) . ' ' . ucfirst($hotel->country);
                                    @endphp
                                    <span class="field" data-all="{{ $address }}"
                                        data-less="{{ Str::limit($address, 15) }}">{{ Str::limit($address, 15) }}</span>

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
                                    {{-- show btn --}}
                                    <button data-modal-target="show-modal-{{ $hotel->id }}"
                                        data-modal-toggle="show-modal-{{ $hotel->id }}"
                                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        Afficher
                                    </button>

                                    {{-- show modal --}}
                                    <div id="show-modal-{{ $hotel->id }}" tabindex="-1" aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-4xl overflow-y-scroll"
                                            style="max-height: 45rem">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="show-modal-{{ $hotel->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                {{-- modal content --}}
                                                <div class="p-4 md:p-5">
                                                    <div
                                                        class="flex justify-between mb-1 text-gray-500 dark:text-gray-400">
                                                        <div class="mt-2 text-gray-600">
                                                            <div class="text-3xl font-bold">{{ $hotel->name }}</div>
                                                            <div class="text-sm mt-1">Nombre de chambres : <span
                                                                    class="font-medium">{{ $hotel->number_rooms }}</span>
                                                            </div>
                                                            <div class="flex items-center text-sm mt-1">
                                                                Classification : <span
                                                                    class="font-medium ms-2">{{ $hotel->classification }}</span>
                                                                <svg class="w-4 h-4 text-yellow-300 ms-1"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    fill="currentColor" viewBox="0 0 22 20">
                                                                    <path
                                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-sm mt-1">Description : <span
                                                                    class="font-medium">{{ $hotel->description }}</span>
                                                            </div>
                                                            <div class="text-sm mt-1">Adresse : <span
                                                                    class="font-medium">{{ $hotel->address . ', ' . $hotel->city . ', ' . $hotel->country }}</span>
                                                            </div>
                                                            <div class="text-sm mt-1">N° tél : <span
                                                                    class=" font-medium">{{ $coordinates['phone_code'] . ' ' . $coordinates['phone'] }}</span>
                                                            </div>
                                                            <div class="text-sm mt-1">Email : <span
                                                                    class=" font-medium">{{ $coordinates['email'] }}</span>
                                                            </div>
                                                            @if (!empty($coordinates['website']))
                                                                <div class="text-sm mt-1">Site web : <a
                                                                        href="{{ $coordinates['website'] }}"
                                                                        class=" font-medium underline text-blue-700">{{ $coordinates['website'] }}</a>
                                                                </div>
                                                            @endif
                                                            @if (!empty($coordinates['facebook']))
                                                                <div class="text-sm mt-1">Facebook : <a
                                                                        href="{{ $coordinates['facebook'] }}"
                                                                        class=" font-medium underline text-blue-700">{{ $coordinates['facebook'] }}</a>
                                                                </div>
                                                            @endif
                                                            @if (!empty($coordinates['instagram']))
                                                                <div class="text-sm mt-1">Instagram : <a
                                                                        href="{{ $coordinates['instagram'] }}"
                                                                        class="font-medium underline text-blue-700">{{ $coordinates['instagram'] }}</a>
                                                                </div>
                                                            @endif
                                                            @if (!empty($coordinates['booking']))
                                                                <div class="text-sm mt-1">Booking : <a
                                                                        href="{{ $coordinates['booking'] }}"
                                                                        class="font-medium underline text-blue-700">{{ $coordinates['booking'] }}</a>
                                                                </div>
                                                            @endif
                                                            <div class="flex flex-wrap mt-2 select-none"
                                                                id="tagButtons">
                                                                @foreach ($services as $tag)
                                                                    <span
                                                                        class="bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300 inline-flex items-center cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                                                        {{ $tag }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                            <div class="mt-5">
                                                                <div class="grid gap-4 w-full" x-data="">
                                                                    <div>
                                                                        <img style="min-width: 100%"
                                                                            x-ref="main{{ $hotel->id }}"
                                                                            id="main-img-{{ $hotel->id }}"
                                                                            class="h-auto max-w-full rounded-lg"
                                                                            src="{{ asset('storage/' . $assets[0]['path']) }}">
                                                                    </div>
                                                                    <div
                                                                        class="flex gap-1">
                                                                        @foreach ($assets as $asset)
                                                                            <div>
                                                                                <img x-on:click="$refs.main{{ $hotel->id }}.src = $el.src" 
                                                                                    class="h-24 max-w-full rounded-lg small-img-{{ $hotel->id }}"
                                                                                    src="{{ asset('storage/' . $asset['path']) }}"
                                                                                    alt="">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div
                                                    class="flex justify-center items-center pb-2 space-x-2 rtl:space-x-reverse">
                                                    <button data-modal-hide="show-modal-{{ $hotel->id }}"
                                                        type="button"
                                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        Fermer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit button -->
                                    <a href="{{ route('admin.hotel.edit', ['id' => $hotel->id]) }}">
                                        <button
                                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            type="button">
                                            Editer
                                        </button>
                                    </a>

                                    <button data-modal-target="delete-hotel-modal-{{ $hotel->id }}"
                                        {{-- Delete button --}}
                                        data-modal-toggle="delete-hotel-modal-{{ $hotel->id }}"
                                        class="px-2.5 py-2 rounded-md text-sm text-white bg-red-700 shadow focus:outline-none focus:ring-2 focus:ring-red-400 hover:bg-red-800">
                                        Archiver
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


        <div class="mt-4">
            {{ $hotels->appends(request()->query())->links() }}
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
