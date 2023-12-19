<x-admin-layout>
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
                    placeholder="Rechercher des voyage organisé">
            </div>

            <!-- create button -->
            <a href="{{ route('admin.trip.create') }}">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Créer un nouveau voyage organisé
                </button>
            </a>
        </div>

        @dump($trips)
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
                                    href="{{ route('trip', ['slug' => $trip->slug]) }}">
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
                                <span>{{ $trip->tripCategory->name }}</span>
                            </td>

                            {{-- description --}}
                            <td class="px-2 py-4">
                                <span class="field">{!! Str::limit($trip->description, 20) !!}...</span>
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
