<x-admin-layout>
    {{-- filter --}}
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between">

        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
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

    </div>

    @if (session('status'))
        <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif
    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        utilisateur
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Nom Prénom
                    </th>
                    <th scope="col" class="px-2 py-3">
                        COORDONNÉES
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Date de naissance
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Sexe
                    </th>
                    <th scope="col" class="px-2 py-3">
                        créer à
                    </th>
                    <th scope="col" class="px-2 py-3">
                        N° réservation
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="underline" target="_blank" href="#">
                                {{ $user->uuid }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M137.54,186.36a8,8,0,0,1,0,11.31l-9.94,10A56,56,0,0,1,48.38,128.4L72.5,104.28A56,56,0,0,1,149.31,102a8,8,0,1,1-10.64,12,40,40,0,0,0-54.85,1.63L59.7,139.72a40,40,0,0,0,56.58,56.58l9.94-9.94A8,8,0,0,1,137.54,186.36Zm70.08-138a56.08,56.08,0,0,0-79.22,0l-9.94,9.95a8,8,0,0,0,11.32,11.31l9.94-9.94a40,40,0,0,1,56.58,56.58L172.18,140.4A40,40,0,0,1,117.33,142,8,8,0,1,0,106.69,154a56,56,0,0,0,76.81-2.26l24.12-24.12A56.08,56.08,0,0,0,207.62,48.38Z">
                                    </path>
                                </svg>
                            </a>
                        </th>
                        {{-- full name --}}
                        <th class="px-2 py-4">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </th>
                        {{-- coordinates --}}
                        <th class="px-2 py-4">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z">
                                    </path>
                                </svg>
                                <span class="font-medium">{{ $user->email }}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                                    </path>
                                </svg>
                                <span class="font-medium">
                                    {{ $user->phone }}</span>
                            </div>
                        </th>
                        {{-- objet --}}
                        <th class="px-2 py-4">
                            {{ $user->dob }}
                        </th>
                        {{-- Message --}}
                        <th class="px-2 py-4">
                            {{ $user->sex }}
                        </th>
                        {{-- created_at --}}
                        <th class="px-2 py-4">
                            {{ $user->created_at }}
                        </th>
                        {{-- counts --}}
                        <th class="px-2 py-4 text-center">
                            {{ $user->bookings_count }}
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="py-4">
        {{ $users }}
    </div>
</x-admin-layout>
