<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Admin panel' }}</title>
</head>
<body>

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">

                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg 2xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="{{ route('welcome') }}" class="flex ms-2 md:me-24">
                        <img src="{{ asset('storage/logo.png') }}" class="h-8 me-3" alt="BestTour Logo" />
                    </a>
                </div>

                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center me-5">

                            <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                                class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
                                type="button">
                                <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 14 20">
                                    <path
                                        d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                                </svg>
                                @empty(Auth::user()->unReadNotifications)
                                    <div style="left: 1rem; top: 0rem;"
                                        class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full dark:border-gray-900">
                                    </div>
                                @endempty
                            </button>
                        </div>

                        <!-- Dropdown notification -->
                        <div id="dropdownNotification" data-dropdown-offset-skidding="-100"
                            class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
                            aria-labelledby="dropdownNotificationButton">
                            <div
                                class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                Notifications
                            </div>
                            <div class="divide-y divide-gray-100 dark:divide-gray-700 max-h-96 overflow-y-auto">
                                @forelse ($notifications as $notification)
                                    <a href="{{ route('admin.booking.show', ['ref' => $notification->data['ref']]) }}"
                                        class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="text-sm relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 border">
                                                <span class="font-medium text-gray-600 dark:text-gray-300">
                                                    {{ strtoupper(substr($notification->data['first_name'], 0, 1) . substr($notification->data['last_name'], 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="w-full ps-3">
                                            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                                                Réservation de
                                                <span class="font-semibold text-gray-900 dark:text-white">
                                                    {{ $notification->data['first_name'] . ' ' . $notification->data['last_name'] }}
                                                </span>
                                                pour
                                                {{ $notification->data['type'] === 'ticketing' ? 'un billet d\'avion.' : '' }}
                                                {{ $notification->data['type'] === 'trip' ? 'un voyage organisé.' : '' }}
                                                {{ $notification->data['type'] === 'hotel' ? 'l\'hôtel.' : '' }}
                                            </div>
                                            <div class="text-xs text-blue-600 dark:text-blue-500">
                                                @php
                                                    $carbon = new \Carbon\Carbon(new DateTime($notification->data['booked_at']));
                                                @endphp
                                                {{ $carbon->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div
                                        class="flex flex-col items-center justify-center px-4 py-2 font-medium text-gray-700 bg-white dark:bg-gray-800 dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-700 h-16 w-16"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm-8-80V80a8,8,0,0,1,16,0v56a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,172Z">
                                            </path>
                                        </svg>
                                        Vous n'avez aucune notification
                                    </div>
                                @endforelse
                            </div>
                            <a href="#"
                                class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                <div class="inline-flex items-center ">
                                    <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                        <path
                                            d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                    Marque comme lu
                                </div>
                            </a>
                        </div>

                        <div>
                            <button type="button"
                                class="text-sm  focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 border"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <span class="font-medium text-gray-600 dark:text-gray-300">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                                </span>
                            </button>
                        </div>

                        {{-- DROPDOWN user menu --}}
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('welcome') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Mon Site</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Profile</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" href="{{ route('logout') }}"
                                            class="text-start w-full inline px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">
                                            Déconnecter
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 2xl:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                @php
                    $selectedButton = ' border-l-4 border-blue-400 bg-gray-100 ';

                    // dashboard
                    $routeIsDashboard = request()->routeIs('dashboard');

                    // agency
                    $routeIsAdminAgency = request()->routeIs('admin.agency');
                    $routeIsAdminAgencyEdit = request()->routeIs('admin.agency.edit');
                    $routeIsAdminAgencyNewCoordinates = request()->routeIs('admin.agency.newCoordinates');
                    $routeIsAdminAgencyEditCoordinates = request()->routeIs('admin.agency.editCoordinates');

                    // trips
                    $routeIsAdminTrips = request()->routeIs('admin.trips');
                    $routeIsAdminTripCreate = request()->routeIs('admin.trip.create');
                    $routeIsAdminTripEdit = request()->routeIs('admin.trip.edit');

                    // hotels
                    $routeIsAdminHotels = request()->routeIs('admin.hotels');
                    $routeIsAdminHotelCreate = request()->routeIs('admin.hotel.create');
                    $routeIsAdminHotelShow = request()->routeIs('admin.hotel.show');
                    $routeIsAdminHotelEdit = request()->routeIs('admin.hotel.edit');

                    // bookings
                    $routeIsAdminBookingsTrip = request()->routeIs('admin.bookings.trip');
                    $routeIsAdminBookingsHotel = request()->routeIs('admin.bookings.hotel');
                    $routeIsAdminBookingsTicketing = request()->routeIs('admin.bookings.ticketing');
                    $routeIsAdminBookingShow = request()->routeIs('admin.booking.show');
                    $routeBookings = $routeIsAdminBookingsTrip || $routeIsAdminBookingsHotel || $routeIsAdminBookingsTicketing || $routeIsAdminBookingShow;

                    // inbox
                    $routeIsAdminInboxs = request()->routeIs('admin.inboxs');

                    // users
                    $routeIsAdminUsers = request()->routeIs('admin.users');
                    $routeIsAdminUserShow = request()->routeIs('admin.users.show');

                    // faq
                    $routeIsAdminFaq = request()->routeIs('admin.faq');

                    // reductions & offers
                    $routeIsAdminReduction = request()->routeIs('admin.reductions');
                @endphp

                {{-- dashboard --}}
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ $routeIsDashboard ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                {{-- Agency --}}
                <li>
                    <a href="{{ route('admin.agency') }}"
                        class="{{ $routeIsAdminAgency || $routeIsAdminAgencyEdit || $routeIsAdminAgencyNewCoordinates || $routeIsAdminAgencyEditCoordinates ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            version="1.0" viewBox="0 0 118.000000 128.000000" fill="currentColor">

                            <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)" stroke="none">
                                <path
                                    d="M541 1257 c-79 -40 -84 -158 -9 -198 12 -6 40 -12 62 -12 33 0 45 6 73 36 22 25 33 47 33 67 0 87 -86 145 -159 107z" />
                                <path
                                    d="M383 1004 c-55 -28 -74 -71 -80 -184 l-6 -100 57 0 56 0 0 70 c0 40 4 70 10 70 6 0 10 -30 10 -70 l0 -70 155 0 155 0 0 70 c0 56 3 70 15 70 12 0 15 -14 15 -70 l0 -70 51 0 51 0 -4 104 c-3 118 -16 147 -79 178 -48 25 -357 26 -406 2z" />
                                <path
                                    d="M10 625 l0 -65 55 0 55 0 0 -275 0 -275 465 0 465 0 0 275 0 275 60 0 60 0 0 65 0 65 -580 0 -580 0 0 -65z m699 -108 c22 -15 53 -46 68 -69 24 -36 28 -51 28 -118 0 -67 -4 -82 -28 -118 -15 -23 -46 -54 -69 -69 -36 -24 -51 -28 -118 -28 -67 0 -82 4 -118 28 -63 41 -95 97 -100 171 -6 97 36 173 121 216 61 31 158 25 216 -13z" />
                                <path
                                    d="M572 503 c-13 -5 -42 -55 -42 -73 0 -6 25 -10 60 -10 35 0 60 4 60 10 0 30 -46 87 -63 79 -1 0 -8 -3 -15 -6z" />
                                <path
                                    d="M461 461 c-38 -36 -39 -41 -2 -41 19 0 30 6 34 18 2 9 8 25 12 35 11 26 -9 21 -44 -12z" />
                                <path
                                    d="M675 473 c4 -10 10 -26 12 -35 4 -12 15 -18 35 -18 27 0 29 2 17 18 -33 43 -77 67 -64 35z" />
                                <path
                                    d="M408 355 c-3 -14 -3 -36 0 -50 4 -21 10 -25 38 -25 l34 0 0 50 0 50 -34 0 c-28 0 -34 -4 -38 -25z" />
                                <path
                                    d="M514 355 c-3 -14 -3 -36 0 -50 6 -24 10 -25 76 -25 66 0 70 1 76 25 3 14 3 36 0 50 -6 24 -10 25 -76 25 -66 0 -70 -1 -76 -25z" />
                                <path
                                    d="M700 330 l0 -50 34 0 c28 0 34 4 38 25 3 14 3 36 0 50 -4 21 -10 25 -38 25 l-34 0 0 -50z" />
                                <path
                                    d="M444 219 c16 -24 55 -53 61 -47 3 2 -1 19 -7 36 -10 26 -18 32 -41 32 -27 0 -27 -1 -13 -21z" />
                                <path
                                    d="M530 230 c0 -6 7 -24 15 -39 25 -50 65 -50 90 0 24 45 20 49 -45 49 -35 0 -60 -4 -60 -10z" />
                                <path
                                    d="M682 208 c-6 -17 -10 -34 -7 -36 6 -6 45 23 61 47 14 20 14 21 -13 21 -23 0 -31 -6 -41 -32z" />
                            </g>
                        </svg>
                        <span class="ms-3">Gestion d'agence</span>
                    </a>
                </li>

                {{-- Trip --}}
                <li>
                    <a href="{{ route('admin.trips') }}"
                        class="{{ $routeIsAdminTrips || $routeIsAdminTripCreate || $routeIsAdminTripEdit ? $selectedButton : '' }}  flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 122.88 107.54">
                            <path
                                d="M88.42,68.75a48.8,48.8,0,0,1-4.74,11.1h9.89a7.67,7.67,0,0,0,1.35.65h0a7,7,0,0,0,6.68-1l2.72-1.85a53.3,53.3,0,0,1-4.25,7.66,50.16,50.16,0,0,1-13.6,13.59,52,52,0,0,1-8.6,4.67,49.29,49.29,0,0,1-9.57,3,52.37,52.37,0,0,1-20.27,0,49,49,0,0,1-9.41-2.91l-.16-.06a52.41,52.41,0,0,1-8.6-4.67,49.81,49.81,0,0,1-7.46-6.14c-1-1-1.94-2-2.85-3.1a48.57,48.57,0,0,1,4.54-3.46q1.13,1.31,2.34,2.52h0a43.34,43.34,0,0,0,6.59,5.43,47.51,47.51,0,0,0,7.69,4.16l.13.06a42.89,42.89,0,0,0,8.3,2.55c.71.14,1.44.27,2.17.37a90.25,90.25,0,0,1-16-17.24h-8c3-1.9,6.34-3.75,9.65-5.49.25.43.51.85.78,1.27H56V69.62l1.4-.59a6.73,6.73,0,0,0,3,2.93v7.89H78.57c4.34-6.81,6.68-13.67,7-20.57l2.88,9.47ZM51.35,52.45c.68-2.17,2.57-3.91,5.31-5.67L47.3,35.84c-.63-.55-.47-1,.12-1.39l3.11-1.33a1.82,1.82,0,0,1,1.51.19l13.59,6.85,16-9.25L59.51,3.41c-.57-.63-.49-1.12.4-1.44l5-2L98.15,21.46l12-5.83c4.57-2,8.51-2.32,11-.83a2.9,2.9,0,0,1,1.78,3c.05,3-2.46,6.24-6.89,9l-12.47,4.86-1,39.53-4.46,3c-.77.55-1.22.35-1.42-.48L86.37,40l-16.64,8L67.73,63A1.85,1.85,0,0,1,67,64.38L64.17,66.2c-.65.26-1.11.14-1.2-.69l-3.76-13.9c-3,1.28-5.52,1.86-7.7,1.18-.2-.06-.22-.15-.16-.34Zm-4.2-6.93c-13.22,7-30.9,18.37-37.4,25C-11.51,92.41,5.08,109.47,29.92,102c-7.78-1.15-13.87-2.72-17.25-4.94-14.43-9.48,32-29.94,42.86-34.42l-.85-3.15a13.18,13.18,0,0,1-5.07-.53L49,58.69a6.05,6.05,0,0,1-3.55-3.51l-.13-.35a6.08,6.08,0,0,1-.07-4.26,13.1,13.1,0,0,1,2.41-4.47l-.49-.58ZM8,63.11A53.31,53.31,0,0,1,7.66,57a51.43,51.43,0,0,1,1-10.14,48.27,48.27,0,0,1,2.9-9.41l.06-.15a53.32,53.32,0,0,1,4.68-8.61,49.17,49.17,0,0,1,6.13-7.45,49.81,49.81,0,0,1,7.46-6.14,52.41,52.41,0,0,1,8.6-4.67,49.51,49.51,0,0,1,9.57-3,51.5,51.5,0,0,1,5.87-.82,9.24,9.24,0,0,0,.74,1l5.72,7.13V29.86H70.61l-5.19,3L56,28.12V14.71A104.13,104.13,0,0,0,41.56,29.86h1.33a6.85,6.85,0,0,0-2.17,3.5,5.42,5.42,0,0,0-.17.8l0,.09H38.48A51.72,51.72,0,0,0,32.74,46c-1.81,1.09-3.63,2.2-5.43,3.34a50.67,50.67,0,0,1,6-15.13H19.54a48.92,48.92,0,0,0-2.67,5.32l-.06.13A42.11,42.11,0,0,0,14.26,48a44.76,44.76,0,0,0-.82,6.82H19a130.39,130.39,0,0,0-11,8.3Zm77.51-3.9H74.7l.59-4.4h8.9l1.33,4.4ZM81,84.07a90.83,90.83,0,0,1-16,17.25c.73-.11,1.45-.24,2.17-.38a43.49,43.49,0,0,0,8.42-2.61,47.09,47.09,0,0,0,7.69-4.16,43.34,43.34,0,0,0,6.59-5.43h0A42.75,42.75,0,0,0,94,84.07ZM60.38,99.5A93.83,93.83,0,0,0,75.62,84.07H60.38V99.5ZM56,84.07H40.75A94.23,94.23,0,0,0,56,99.5V84.07ZM36.16,29.86A100.58,100.58,0,0,1,51.72,12.65c-.86.12-1.71.26-2.55.43a42,42,0,0,0-8.43,2.61,47.51,47.51,0,0,0-7.69,4.16,43.34,43.34,0,0,0-6.59,5.43h0a43.24,43.24,0,0,0-4,4.57Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Voyages organisée</span>
                        <span
                            class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                    </a>
                </li>

                {{-- Hotels --}}
                <li>
                    <a href="{{ route('admin.hotels') }}"
                        class="{{ $routeIsAdminHotels || $routeIsAdminHotelCreate || $routeIsAdminHotelShow || $routeIsAdminHotelEdit ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.0"
                            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" stroke="none">
                                <path
                                    d="M45 4228 c-47 -25 -45 53 -45 -1666 0 -1020 4 -1630 10 -1641 5 -10 22 -24 39 -30 24 -10 34 -10 59 3 16 8 32 23 36 31 3 9 6 309 6 666 l0 649 90 0 90 0 -6 -80 c-8 -93 4 -134 44 -148 31 -11 69 0 87 25 7 9 15 59 19 112 13 179 55 333 133 481 198 376 553 613 976 650 65 6 127 15 138 20 24 13 35 55 23 89 -15 41 -48 51 -146 44 l-88 -6 0 92 0 91 285 0 285 0 0 -349 0 -349 -29 -11 c-67 -28 -116 -106 -127 -204 l-7 -55 -271 -4 -271 -4 -62 -28 c-64 -29 -128 -88 -156 -142 -35 -68 -38 -138 -35 -744 l3 -595 26 -55 c33 -70 89 -126 159 -159 l55 -26 1755 0 c1667 0 1757 1 1795 18 104 47 173 127 194 227 9 40 11 220 9 660 l-3 605 -24 53 c-29 65 -113 143 -178 167 -40 15 -93 19 -319 23 l-271 4 -6 57 c-2 32 -14 76 -26 98 -21 43 -95 113 -118 113 -10 0 -13 67 -13 350 l0 350 388 0 c387 0 387 0 438 24 104 48 156 166 122 277 -15 51 -69 114 -122 142 l-41 22 -2397 3 -2398 2 0 49 c0 64 -6 79 -41 96 -33 18 -38 18 -64 3z m4875 -311 c54 -27 64 -97 19 -135 -18 -15 -67 -17 -535 -22 l-516 -5 -19 -24 c-25 -31 -24 -69 3 -98 18 -19 32 -23 80 -23 l58 0 0 -344 0 -343 -49 -30 c-67 -42 -104 -107 -109 -190 l-4 -63 -729 0 -729 0 0 55 c0 91 -45 167 -121 206 l-39 20 2 342 3 342 702 5 c644 5 704 6 719 22 24 24 22 75 -5 101 l-22 22 -1739 3 -1740 2 0 85 0 85 2373 0 c1877 0 2377 -3 2397 -13z m-3560 -412 c0 -76 -4 -107 -12 -109 -268 -77 -445 -180 -628 -365 -166 -167 -265 -326 -333 -536 l-32 -100 -103 -3 -102 -3 0 611 0 610 605 0 605 0 0 -105z m839 -740 c33 -17 41 -33 41 -86 l0 -39 -85 0 c-83 0 -85 1 -85 24 0 41 21 86 49 101 33 18 46 18 80 0z m1945 -14 c10 -11 20 -39 23 -65 l6 -46 -87 0 -86 0 0 43 c1 44 12 66 45 85 26 16 75 7 99 -17z m746 -293 c18 -13 43 -36 54 -51 21 -28 21 -37 24 -634 2 -597 2 -606 -18 -649 -13 -26 -36 -53 -58 -66 l-37 -23 -1735 0 c-1629 0 -1738 1 -1762 17 -15 10 -39 34 -55 55 l-28 36 -3 601 -2 601 22 45 c13 25 38 55 57 67 l34 23 1737 0 1737 0 33 -22z" />
                                <path
                                    d="M1650 2128 c-19 -21 -20 -33 -20 -366 0 -223 4 -350 11 -363 24 -46 105 -42 128 7 6 14 11 78 11 149 l0 125 125 0 125 0 0 -129 c0 -71 3 -137 6 -146 4 -8 19 -22 34 -30 36 -19 83 -4 99 31 7 17 11 130 11 358 0 322 -1 334 -21 360 -27 34 -77 36 -107 3 -20 -22 -22 -33 -22 -160 l0 -137 -125 0 -125 0 0 134 c0 120 -2 136 -21 160 -27 34 -79 36 -109 4z" />
                                <path
                                    d="M2495 2137 c-88 -35 -153 -106 -176 -190 -6 -24 -9 -110 -7 -211 3 -159 5 -174 28 -219 47 -93 141 -151 245 -150 108 0 195 54 247 153 22 43 23 55 23 240 0 183 -1 198 -23 237 -29 54 -78 104 -128 128 -47 23 -166 30 -209 12z m173 -171 l37 -34 3 -161 c3 -149 2 -164 -17 -195 -21 -34 -73 -66 -106 -66 -33 0 -85 32 -106 66 -19 31 -20 46 -17 195 l3 161 37 34 c31 28 45 34 83 34 38 0 52 -6 83 -34z" />
                                <path
                                    d="M2951 2124 c-24 -31 -26 -43 -10 -78 15 -32 56 -46 130 -46 l59 0 0 -285 c0 -191 4 -292 11 -309 16 -35 63 -50 99 -31 15 8 30 22 34 30 3 9 6 147 6 306 l0 289 59 0 c69 0 118 15 131 40 16 30 12 64 -10 88 -20 21 -27 22 -255 22 l-234 0 -20 -26z" />
                                <path
                                    d="M3614 2129 c-18 -20 -19 -43 -22 -357 -2 -238 1 -344 9 -364 17 -42 60 -50 252 -46 163 3 169 4 188 27 26 32 24 73 -4 99 -22 20 -33 22 -160 22 l-137 0 0 84 0 84 101 4 c92 3 103 5 120 27 25 30 24 76 -1 101 -17 17 -33 20 -120 20 l-100 0 0 85 0 85 119 0 c125 0 175 11 191 40 16 30 12 68 -10 90 -19 19 -33 20 -213 20 -184 0 -195 -1 -213 -21z" />
                                <path
                                    d="M4214 2129 c-18 -20 -19 -41 -19 -370 l0 -348 23 -23 c22 -22 28 -23 211 -23 172 0 191 2 210 19 25 22 28 73 7 102 -13 17 -31 20 -158 24 l-143 5 -5 303 c-5 286 -6 304 -24 318 -29 21 -80 18 -102 -7z" />
                            </g>
                        </svg>
                        <span class="ms-3">Manage Hôtels</span>
                    </a>
                </li>

                {{-- Booking --}}
                <li>
                    <button type="button"
                        class="{{ $routeBookings ? $selectedButton : '' }} flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 21">
                            <path
                                d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                            Réservation
                        </span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="{{ $routeBookings ? '' : 'hidden' }} py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.bookings.trip') }}"
                                class="{{ $routeIsAdminBookingsTrip ? 'bg-gray-100' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                Voyage organisé
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.bookings.hotel') }}"
                                class="{{ $routeIsAdminBookingsHotel ? 'bg-gray-100' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                Hôtel
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.bookings.ticketing') }}"
                                class="{{ $routeIsAdminBookingsTicketing ? 'bg-gray-100' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                Billeterie
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Inbox --}}
                <li>
                    <a href="{{ route('admin.inboxs') }}"
                        class="{{ $routeIsAdminInboxs ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium  px-2 py-0.5 rounded-xl dark:bg-blue-900 dark:text-blue-300">
                            {{ \App\Models\Contact::where('status', 'non lu')->count() }}
                        </span>
                    </a>
                </li>

                {{-- users --}}
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="{{ $routeIsAdminUsers || $routeIsAdminUserShow ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Utilisateur</span>
                    </a>
                </li>

                {{-- offers --}}
                <li>
                    <a href="{{ route('admin.reductions') }}"
                        class="{{ $routeIsAdminReduction ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Réduction & cadeau</span>
                    </a>
                </li>

                {{-- faq --}}
                <li>
                    <a href="{{ route('admin.faq') }}"
                        class="{{ $routeIsAdminFaq ? $selectedButton : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.0"
                            class="flex-shrink-0  w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"
                            fill="currentColor">

                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" stroke="none">
                                <path
                                    d="M1002 4829 c-503 -66 -905 -457 -987 -959 -12 -78 -15 -207 -15 -727 0 -395 4 -660 11 -709 67 -486 443 -881 927 -975 l62 -12 0 -524 c0 -521 0 -526 22 -564 23 -41 84 -79 126 -79 62 0 101 35 662 595 l565 565 846 0 c705 0 861 2 932 15 496 86 872 464 952 955 22 137 22 1307 0 1453 -36 241 -148 461 -325 638 -158 158 -332 255 -560 312 -84 21 -94 21 -1620 23 -844 1 -1563 -2 -1598 -7z m3113 -304 c328 -57 581 -290 677 -622 23 -78 23 -81 23 -768 l0 -690 -28 -88 c-101 -323 -340 -539 -665 -603 -61 -11 -231 -14 -958 -14 -790 0 -888 -2 -917 -16 -18 -9 -238 -221 -489 -472 l-458 -457 0 414 c0 406 0 414 -22 452 -28 49 -86 79 -155 79 -112 0 -268 43 -382 106 -231 127 -393 361 -431 622 -8 52 -10 284 -8 722 l3 645 28 88 c15 49 39 112 54 140 121 240 352 414 610 461 122 22 2992 23 3118 1z" />
                                <path
                                    d="M2403 3839 c-59 -8 -108 -32 -134 -69 -22 -31 -389 -1234 -389 -1277 0 -62 130 -134 218 -119 57 9 76 38 113 179 l33 127 212 0 211 0 34 -127 c44 -163 55 -178 141 -178 77 1 156 39 183 89 16 31 16 33 -175 656 -105 344 -199 636 -209 650 -40 55 -133 82 -238 69z m122 -639 c36 -135 68 -253 71 -262 5 -17 -6 -18 -141 -18 -114 0 -146 3 -143 13 3 6 36 126 73 265 37 139 69 251 71 250 1 -2 32 -113 69 -248z" />
                                <path
                                    d="M1053 3815 c-17 -7 -36 -22 -42 -34 -8 -13 -11 -228 -11 -685 l0 -665 26 -20 c74 -58 220 -48 271 18 9 12 12 89 13 284 l0 267 155 0 c208 0 235 15 235 130 0 38 -6 55 -26 79 l-26 31 -169 0 -169 0 0 170 0 170 268 0 c297 0 301 1 328 66 28 67 9 170 -34 193 -33 18 -778 14 -819 -4z" />
                                <path
                                    d="M3558 3814 c-156 -37 -262 -143 -303 -301 -22 -85 -22 -753 0 -838 42 -159 152 -263 313 -296 l62 -13 0 -68 c0 -85 17 -122 64 -138 27 -9 41 -8 69 3 47 20 51 30 57 121 l5 80 58 13 c181 41 298 163 326 343 17 102 14 691 -3 771 -37 174 -143 283 -317 324 -80 18 -254 18 -331 -1z m259 -273 c30 -14 48 -32 65 -63 22 -42 23 -52 26 -346 2 -200 -1 -321 -8 -357 -11 -51 -50 -115 -71 -115 -5 0 -9 27 -9 60 0 79 -26 110 -94 110 -37 0 -48 -5 -70 -31 -21 -25 -26 -41 -26 -85 0 -58 -7 -65 -34 -35 -41 45 -45 83 -46 419 0 340 3 365 48 416 42 47 145 60 219 27z" />
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Foire au question</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="p-4 2xl:ml-64 mt-14">
        {{ $slot }}
    </main>

    @isset($script)
        <script src="{{ $script }}"></script>
    @endisset
</body>
</html>
