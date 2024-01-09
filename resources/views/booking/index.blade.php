<x-app-layout>
    <x-slot:title>Mes réservations</x-slot:title>
    <div class="mx-4 my-10">

        @if (!$bookings->count())
            <div class="flex justify-center items-start w-full h-96 bg-center bg-cover transition-all duration-300 rounded-lg cursor-pointer filter grayscale hover:grayscale-0 shadow-lg"
                style="background-image: url({{ asset('storage/images/no-booking.jpg') }})">
                <span
                    class="mt-10 uppercase text-3xl font-extrabold dark:text-white md:text-5xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Vous avez aucune réservation
                </span>
            </div>
        @endif

        @if (session('status'))
            <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('status') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @if ($bookings->count())
            <h3
                class="mb-10 text-center uppercase text-3xl font-extrabold dark:text-white md:text-5xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                Mes reservation</h3>
            <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-2 py-3">
                                Rèference
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Type
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Date départ/retour
                            </th>
                            <th scope="col" class="px-2 py-3">
                                status
                            </th>
                            <th scope="col" class="px-2 py-3">
                                prix
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Demandé à
                            </th>
                            <th scope="col" class="px-2 py-3">
                                modifier à
                            </th>
                            <th scope="col" class="px-2 py-3"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                {{-- ref --}}
                                <th scope="row"
                                    class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a class="underline" target="_blank"
                                        href="{{ route('booking.show', ['ref' => $booking->ref]) }}">
                                        {{ $booking->ref }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M137.54,186.36a8,8,0,0,1,0,11.31l-9.94,10A56,56,0,0,1,48.38,128.4L72.5,104.28A56,56,0,0,1,149.31,102a8,8,0,1,1-10.64,12,40,40,0,0,0-54.85,1.63L59.7,139.72a40,40,0,0,0,56.58,56.58l9.94-9.94A8,8,0,0,1,137.54,186.36Zm70.08-138a56.08,56.08,0,0,0-79.22,0l-9.94,9.95a8,8,0,0,0,11.32,11.31l9.94-9.94a40,40,0,0,1,56.58,56.58L172.18,140.4A40,40,0,0,1,117.33,142,8,8,0,1,0,106.69,154a56,56,0,0,0,76.81-2.26l24.12-24.12A56.08,56.08,0,0,0,207.62,48.38Z">
                                            </path>
                                        </svg>
                                    </a>
                                </th>
                                {{-- type --}}
                                <td class="px-2 py-4">
                                    {{ $booking->type }}
                                </td>
                                {{-- date --}}
                                <td class="px-2 py-4">
                                    {{ $booking->date_departure . ' / ' . $booking->date_return }}
                                </td>
                                {{-- status --}}
                                <td class="px-2 py-4">
                                    @if ($booking->status)
                                        <div class="flex items-center">
                                            <div
                                                class="h-2.5 w-2.5 rounded-full {{ $booking->status == 'validé' ? 'bg-green-500' : 'bg-red-500' }} me-2">
                                            </div>
                                            {{ $booking->status }}
                                        </div>
                                    @endif
                                </td>
                                {{-- price --}}
                                <td>
                                    {{ $booking->price ? $booking->price . ' DA' : '' }}
                                </td>
                                {{-- created at --}}
                                <td class="px-2 py-4">
                                    {{ $booking->created_at }}
                                </td>
                                {{-- updated at --}}
                                <td class="px-2 py-4">
                                    {{ $booking->updated_at }}
                                </td>
                                {{-- actions --}}
                                <td class="px-2 py-4">
                                    <button class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                        Afficher
                                    </button>

                                    {{-- edit btn --}}
                                    <button
                                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-2 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                                        type="button">
                                        Editer
                                    </button>
                                    {{-- edit modal --}}

                                    {{-- delete btn --}}
                                    <button data-modal-target="delete-booking-modal-{{ $booking->id }}"
                                        data-modal-toggle="delete-booking-modal-{{ $booking->id }}"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                        type="button">
                                        Annuler
                                    </button>

                                    {{-- Delete modal --}}
                                    <div id="delete-booking-modal-{{ $booking->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="delete-booking-modal-{{ $booking->id }}">
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
                                                            class="text-black font-medium">{{ $booking->type }}</span>?
                                                    </h3>
                                                    <div class="flex gap-1 justify-center items-center">
                                                        <form method="post"
                                                            action="{{ route('booking.delete', ['ref' => $booking->ref]) }}">
                                                            @csrf @method('delete')
                                                            <button
                                                                data-modal-hide="delete-booking-modal-{{ $booking->id }}"
                                                                type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                        <button
                                                            data-modal-hide="delete-booking-modal-{{ $booking->id }}"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div id="alert-additional-content-1"
            class="mt-5 p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">N'hésiter pas à nous contacter</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                Si vous voulez des informations suplémentaire sur quoi que ce soit n'hésiter pas à nous contacter via
                notre formulaire de contact ou nous passer un cout de fil.
            </div>
        </div>
</x-app-layout>
