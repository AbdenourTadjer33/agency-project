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
                    Filtré les résultats
                    <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="hidden w-72 z-50 p-3 bg-white rounded-lg shadow-xl dark:bg-gray-700">
                    <h1 class="mb-2 text-base font-semibold text-gray-600">Filter</h1>
                    <form action="{{ route('admin.bookings.ticketing') }}" method="get">
                        {{-- status --}}
                        {{-- <div>
                            <h6 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Status
                            </h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                <li class="flex items-center">
                                    <input id="all" name="status" type="radio" value="all"
                                        {{ (request()->status == 'all') | (request()->status == null) | (old('status') == 'all') ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />

                                    <label for="all"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Tous les status
                                    </label>
                                </li>
                                @foreach (\App\Models\Booking::ALLSTATUS as $status)
                                    <li class="flex items-center">
                                        <input id="{{ $status }}" name="status" type="radio"
                                            value="{{ $status }}"
                                            {{ (request()->status == $status) | (old('status') == $status) ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />

                                        <label for="{{ $status }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $status }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div> --}}
                        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                        {{-- date de creation --}}
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="order_by" value="latest"
                                    {{ !request()->order_by ? 'checked' : '' }} class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Les plus
                                    récent</span>
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
                <form action="{{ route('admin.bookings.delete') }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Archiver les voyages
                    </button>
                </form>
                <a href="{{ route('admin.hotel.create') }}">
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

                            </td>
                        </tr>
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
