<x-admin-layout>
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
                        {{-- category --}}
                        <div>
                            <h6 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Catégorie
                            </h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                <li class="flex items-center">
                                    <input id="all" name="category" type="radio" value="all"
                                        {{ (request()->category == 'all') | (request()->category == null) | (old('category') == 'all') ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />

                                    <label for="all"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Tous les catégorie
                                    </label>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="flex items-center">
                                        <input id="{{ $category['id'] }}" name="category" type="radio"
                                            value="{{ $category['id'] }}"
                                            {{ (request()->category == $category['id']) | (old('category') == $category['id']) ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />

                                        <label for="{{ $category['id'] }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $category['name'] }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
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
                <form action="{{ route('admin.trips.archive') }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="px-2.5 py-2 rounded-md text-sm text-white bg-red-700 shadow focus:outline-none focus:ring-2 focus:ring-red-400 hover:bg-red-800">
                        Archiver les voyages expirée
                    </button>
                </form>
                <a href="{{ route('admin.trip.create') }}">
                    <button
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Créer un nouveau voyage organisé
                    </button>
                </a>
            </div>
        </div>

        {{-- table --}}
        <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Voyage organisé
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Categorie
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Destination
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Hébergement
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
                    @foreach ($trips as $trip)
                        @php
                            $assets = $trip->assets;
                            if (!is_array($assets)) {
                                $assets = json_decode($assets, true);
                            }
                        @endphp
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            {{-- name --}}
                            <th scope="row"
                                class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a class="underline" target="_blank"
                                    href="{{ route('trip.show', ['slug' => $trip->slug]) }}">
                                    {{ $trip->name }}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M137.54,186.36a8,8,0,0,1,0,11.31l-9.94,10A56,56,0,0,1,48.38,128.4L72.5,104.28A56,56,0,0,1,149.31,102a8,8,0,1,1-10.64,12,40,40,0,0,0-54.85,1.63L59.7,139.72a40,40,0,0,0,56.58,56.58l9.94-9.94A8,8,0,0,1,137.54,186.36Zm70.08-138a56.08,56.08,0,0,0-79.22,0l-9.94,9.95a8,8,0,0,0,11.32,11.31l9.94-9.94a40,40,0,0,1,56.58,56.58L172.18,140.4A40,40,0,0,1,117.33,142,8,8,0,1,0,106.69,154a56,56,0,0,0,76.81-2.26l24.12-24.12A56.08,56.08,0,0,0,207.62,48.38Z">
                                        </path>
                                    </svg>
                                </a>
                            </th>

                            {{-- category --}}
                            <td class="px-2 py-4">
                                {{ $trip->tripCategory->name }}
                            </td>

                            {{-- description --}}
                            <td class="px-2 py-4">
                                {{-- <span class="field">{!! $trip->description !!}...</span> --}}
                                <span class="field" data-all="{{ $trip->description }}"
                                    data-less="{{ Str::limit($trip->description, 40) }}">{{ Str::limit($trip->description, 40) }}</span>

                                <span onclick="showMore(event)"
                                    class="more select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Plus
                                </span>
                                <span onclick="showLess(event)"
                                    class="less hidden select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Moins
                                </span>
                            </td>


                            {{-- destination --}}
                            <td class="px-2 py-6">
                                {{ $trip->destination }}, {{ $trip->city }}
                            </td>

                            {{-- Hotel --}}
                            <td>
                                {{ $trip->hotel->name }}
                            </td>

                            {{-- pricing --}}
                            <td>
                                <span class="block">Adult: {{ $trip->pricing->price_adult }} DA</span>
                                <span class="block">enfant: {{ $trip->pricing->price_child }} DA</span>
                                <span class="block">bébe: {{ $trip->pricing->price_baby }} DA</span>
                            </td>

                            {{-- created_at --}}
                            <td class="px-2 py-4">
                                {{ $trip->created_at }}
                            </td>

                            {{-- updated at --}}
                            <td class="px-2 py-4">
                                {{ $trip->updated_at == $trip->created_at ? '' : $trip->created_at }}
                            </td>

                            {{-- operations --}}
                            <td class="px-2 py-6 inline-flex gap-1">
                                {{-- show btn --}}
                                <button data-modal-target="show-modal-{{ $trip->id }}"
                                    data-modal-toggle="show-modal-{{ $trip->id }}"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Afficher
                                </button>

                                {{-- show modal --}}
                                <div id="show-modal-{{ $trip->id }}" tabindex="-1" aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-4xl overflow-y-scroll"
                                        style="max-height: 45rem">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="show-modal-{{ $trip->id }}">
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
                                                        <div class="text-3xl font-bold">{{ $trip->name }}</div>
                                                        <div class="text-sm mt-1">Hôtel : <span
                                                                class="font-medium">{{ $trip->hotel->name }}</span>
                                                        </div>
                                                        <div class="flex items-center text-sm mt-1">
                                                            Classification : <span
                                                                class="font-medium ms-2">{{ $trip->hotel->classification }}</span>
                                                            <svg class="w-4 h-4 text-yellow-300 ms-1"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="currentColor" viewBox="0 0 22 20">
                                                                <path
                                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                        </div>
                                                        <div class="text-sm mt-1 ">Description : <span
                                                                class="font-medium block">{!! nl2br($trip->description) !!}</span>
                                                        </div>
                                                        <div class="text-sm mt-1">Adresse : <span
                                                                class="font-medium">{{ $trip->city . ', ' . $trip->destination }}</span>
                                                        </div>
                                                        <div class="mt-5">
                                                            <div class="grid gap-4 w-full" x-data="">
                                                                <div>
                                                                    <img style="min-width: 100%"
                                                                        x-ref="main{{ $trip->id }}"
                                                                        id="main-img-{{ $trip->id }}"
                                                                        class="h-auto max-w-full rounded-lg"
                                                                        src="{{ asset('storage/' . $assets[0]['path']) }}">
                                                                </div>
                                                                <div
                                                                    class="flex gap-1">
                                                                    @foreach ($assets as $asset)
                                                                        <div>
                                                                            <img x-on:click="$refs.main{{ $trip->id }}.src = $el.src"
                                                                                class=" h-24 max-w-full rounded-lg small-img-{{ $trip->id }}"
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
                                                <button data-modal-hide="show-modal-{{ $trip->id }}"
                                                    type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- edit --}}
                                <a href="{{ route('admin.trip.edit', ['id' => $trip->id]) }}">
                                    <button
                                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        Editer
                                    </button>
                                </a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $trips->appends(request()->query())->links() }}
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
