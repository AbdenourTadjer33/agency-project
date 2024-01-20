<x-admin-layout>
    <x-slot:title>Admin - Gestion des réservations</x-slot:title>

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
                <form action="{{ route('admin.bookings.trip') }}" method="get">
                    {{-- status --}}
                    <div>
                        <h6 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status
                        </h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                            <li class="flex items-center">
                                <input id="all" name="status" type="radio" value="all"
                                    {{ (request()->status == 'all') | (request()->status == null) | (old('status') == 'all') ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />

                                <label for="all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
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
                    </div>
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
        <div>
            {{-- <form action="{{ route('admin.bookings.delete') }}" method="POST"> --}}
                {{-- @csrf --}}
                {{-- @method('delete') --}}
                <button type="submit"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Archiver les ancien réservation
                </button>
            {{-- </form> --}}
        </div>
    </div>

    @if (count($bookings))
        <div class="mt-4 flex flex-wrap gap-2">
            <div class="w-full max-w-full mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl bg-slate-850 shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div class="flex items-center h-full">
                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase opacity-60 text-sm">
                                        Totale :
                                        {{ $bookings->total() . ' réservation' }}{{ $bookings->total() > 1 ? 's' : '' }}
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


    @php
        $type = ['hotel' => 'Hôtel', 'ticketing' => 'Billetterie', 'trip' => 'Voyage oraganisé'];
    @endphp
    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        Rèference
                    </th>
                    <th scope="col" class="px-2 py-3">
                        utilisateur
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
                    <th scope="col" class="px-2 py-3">
                        action
                    </th>
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
                                href="{{ route('admin.booking.show', ['ref' => $booking->ref]) }}">
                                {{ $booking->ref }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 inline-block" fill="#000000"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M137.54,186.36a8,8,0,0,1,0,11.31l-9.94,10A56,56,0,0,1,48.38,128.4L72.5,104.28A56,56,0,0,1,149.31,102a8,8,0,1,1-10.64,12,40,40,0,0,0-54.85,1.63L59.7,139.72a40,40,0,0,0,56.58,56.58l9.94-9.94A8,8,0,0,1,137.54,186.36Zm70.08-138a56.08,56.08,0,0,0-79.22,0l-9.94,9.95a8,8,0,0,0,11.32,11.31l9.94-9.94a40,40,0,0,1,56.58,56.58L172.18,140.4A40,40,0,0,1,117.33,142,8,8,0,1,0,106.69,154a56,56,0,0,0,76.81-2.26l24.12-24.12A56.08,56.08,0,0,0,207.62,48.38Z">
                                    </path>
                                </svg>
                            </a>
                        </th>
                        {{-- user --}}
                        <th class="px-2 py-4">
                            {{ $booking->user->first_name . ' ' . $booking->user->last_name }}
                        </th>
                        {{-- type --}}
                        <td class="px-2 py-4">
                            {{ $type[$booking->type] }}
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
                            {{ $booking->updated_at == $booking->created_at ? '' : $booking->updated_at }}
                        </td>
                        {{-- actions --}}
                        <td class="px-2 py-4">
                            <button data-modal-target="delete-modal-{{ $booking->ref }}"
                                data-modal-toggle="delete-modal-{{ $booking->ref }}"
                                class="px-2.5 py-2 rounded-md text-sm text-white bg-red-700 shadow focus:outline-none focus:ring-2 focus:ring-red-400 hover:bg-red-800">
                                Supprimer
                            </button>

                            <div id="delete-modal-{{ $booking->ref }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="delete-modal-{{ $booking->ref }}">
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
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                Êtes-vous sûr de vouloir supprimer cette la réservation n°
                                                {{ $booking->ref }} ?
                                            </h3>
                                            <form method="post"
                                                action="{{ route('admin.booking.delete', ['ref' => $booking->ref]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                            <button data-modal-hide="delete-modal-{{ $booking->ref }}" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                cancel</button>
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


</x-admin-layout>
