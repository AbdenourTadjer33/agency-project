<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin panel</title>
</head>

<body>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">

                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
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
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name . '+' . Auth::user()->last_name }}"
                                    alt="user photo">
                            </button>
                        </div>
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
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 xl:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
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

                    // hotels
                    $routeIsAdminHotels = request()->routeIs('admin.hotels');
                    $routeIsAdminHotelCreate = request()->routeIs('admin.hotel.create');
                    $routeIsAdminHotelShow = request()->routeIs('admin.hotel.show');
                    $routeIsAdminHotelEdit = request()->routeIs('admin.hotel.edit');

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

                            <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)" fill="#000000"
                                stroke="none">
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
                        class="{{ $routeIsAdminTrips || $routeIsAdminTripCreate ? $selectedButton : '' }}  flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000"
                                stroke="none">
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

                {{-- Ticketing --}}
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                            shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                            image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                            viewBox="0 0 512 282.9">
                            <path
                                d="M25.92 0l460.16.01c7.12-.03 13.61 2.89 18.31 7.58 4.69 4.69 7.61 11.18 7.61 18.3v231.1c0 7.13-2.92 13.61-7.61 18.3-4.7 4.69-11.19 7.61-18.3 7.61l-460.17-.02c-7.08.03-13.57-2.89-18.27-7.59l-.05-.05C2.93 270.55 0 264.08 0 256.99v-52.35c0-3.61 2.72-6.59 6.22-7.01 12.23-2.64 22.95-9.42 30.58-18.77 7.6-9.33 12.17-21.26 12.17-34.27 0-13.01-4.57-24.95-12.17-34.27-7.75-9.5-18.68-16.35-31.15-18.89a7.029 7.029 0 01-5.62-6.89L0 25.91C0 18.78 2.92 12.29 7.61 7.6 12.31 2.9 18.8-.02 25.92 0zm376.31 266.93c0 .67.06 1.29.19 1.88l-281.98-.02V14.08h281.98c-.13.59-.19 1.21-.19 1.88v15.69c0 10.33 15.69 10.33 15.69 0V15.96c0-.67-.06-1.3-.19-1.88h68.35c3.23.02 6.19 1.36 8.33 3.49 2.13 2.14 3.47 5.1 3.47 8.32v231.1c0 3.23-1.34 6.18-3.47 8.31-2.15 2.15-5.1 3.48-8.32 3.51h-68.36c.13-.59.19-1.21.19-1.88v-15.68c0-10.33-15.69-10.33-15.69 0v15.68zm0-47.05c0 10.33 15.69 10.33 15.69 0v-15.69c0-10.33-15.69-10.33-15.69 0v15.69zm0-47.06c0 10.33 15.69 10.33 15.69 0v-15.69c0-10.33-15.69-10.33-15.69 0v15.69zm0-47.06c0 10.33 15.69 10.33 15.69 0v-15.68c0-10.33-15.69-10.33-15.69 0v15.68zm0-47.06c0 10.33 15.69 10.33 15.69 0V63.02c0-10.33-15.69-10.33-15.69 0V78.7zM200.58 196.28c0-4.99 2.84-9.86 7.45-15.32l-26.69-16.88c-1.68-.73-1.65-1.77-.67-2.97l5.66-4.81c1.04-.64 2.12-.91 3.29-.59l32.94 5.57L250 131.56l-64.07-43.35c-1.61-.96-1.75-2.04-.09-3.28l9.24-7.38 83.54 23.48 24.68-26.39c8.28-7.16 16.33-10.37 22.5-8.85 3.4.84 4.61 1.85 5.65 5.05 2.03 6.26-1.12 14.67-8.61 23.33l-26.39 24.69 23.48 83.53-7.38 9.25c-1.25 1.66-2.33 1.52-3.28-.1l-43.36-64.06-29.72 27.44 5.58 32.93c.31 1.17.05 2.26-.59 3.29l-4.82 5.66c-1.2.98-2.24 1.01-2.97-.66l-16.88-26.7c-5.48 4.63-10.36 7.47-15.37 7.46-.47-.01-.56-.17-.56-.62z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Billeterie</span>
                    </a>
                </li>

                {{-- Inbox --}}
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                    </a>
                </li>

                {{-- users --}}
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Réduction & cadeau</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Page Content -->
    <main class="p-4 xl:ml-64 mt-14">
        {{ $slot }}
    </main>

</body>

</html>
