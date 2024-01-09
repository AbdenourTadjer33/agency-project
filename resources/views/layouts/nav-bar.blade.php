{{-- website navbar --}}
{{-- <nav id="navbar" class="flex justify-between items-center w-full bg-gray-50 py-2 px-5 z-50">
    <div>
        <a href="/"><x-application-logo class="w-20 h-20 fill-current text-gray-500" /></a>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-link :href="route('welcome')" :active="request()->routeIs('welcome')">
            {{ __('Accueil') }}
        </x-link>

        <x-link :href="route('trips')" :active="request()->routeIs('trips') || request()->routeIs('trip.show')">
            {{ __('Voyages Organisé') }}
        </x-link>

        <x-link :href="route('hotels')" :active="request()->routeIs('hotels') || request()->routeIs('hotel.show')">
            {{ __('Hotels') }}
        </x-link>

        <x-link :href="route('ticketing')" :active="request()->routeIs('ticketing')">
            {{ __('Billeterie') }}
        </x-link>

        <x-link :href="route('contact')" :active="request()->routeIs('contact')">
            {{ __('Contact') }}
        </x-link>
    </div>
</nav> --}}

<nav class="bg-white border-gray-200 dark:bg-gray-900 shadow-md">
    <div class="max-w-screen-3xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('welcome') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('storage/logo.png') }}" class=" h-14" alt="Flowbite Logo" />
        </a>
        {{-- auth --}}
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            {{-- auth user --}}
            @if (Auth::check())
                <button type="button"
                    class="inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 px-3 py-2 border-2 hover:ring-1 text-sm leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="font-medium text-gray-600 dark:text-gray-300 ">
                        {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                    </span>
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span
                            class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                        <span
                            class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Profile
                            </a>
                        </li>
                        @if (Auth::user()->isAdmin())
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Dashboard
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('bookings') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Mes réservation
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Déconnecter
                                </button>
                            </form>

                        </li>
                    </ul>
                </div>
            @else
                {{-- log/reg user --}}
                <div class="flex gap-2">
                    <a href="{{ route('login') }}">
                        <button type="button"
                            class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            s'authentifier
                        </button>
                    </a>

                    <a href="{{ route('register') }}" class="hidden sm:block">
                        <button type="button"
                            class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Créer un compte
                        </button>
                    </a>
                </div>
            @endif

            <button data-collapse-toggle="navbar-cta" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="navbar-cta">
            <ul
                class="flex flex-col font-medium p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0 lg:bg-white dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('welcome') }}"
                        class="{{ request()->routeIs('welcome') ? 'lg:text-indigo-700 text-indigo-700 bg-indigo-100 lg:bg-transparent' : 'lg:text-gray-900 lg:bg-transparent' }} block py-2 px-3 rounded lg:p-0"
                        aria-current="page">Accueil</a>
                </li>
                <li>
                    <a href="{{ route('trips') }}"
                        class="{{ request()->routeIs('trips') || request()->routeIs('trip.show') ? 'lg:text-indigo-700 text-indigo-700 bg-indigo-100 lg:bg-transparent' : 'lg:text-gray-900 lg:bg-transparent' }} block py-2 px-3 rounded lg:p-0">Voyages
                        organisés</a>
                </li>
                <li>
                    <a href="{{ route('hotels') }}"
                        class="{{ request()->routeIs('hotels') || request()->routeIs('hotel.show') ? 'lg:text-indigo-700 text-indigo-700 bg-indigo-100 lg:bg-transparent' : 'lg:text-gray-900 lg:bg-transparent' }} block py-2 px-3 rounded lg:p-0">Hotels</a>
                </li>
                <li>
                    <a href="{{ route('ticketing') }}"
                        class="{{ request()->routeIs('ticketing') ? 'lg:text-indigo-700 text-indigo-700 bg-indigo-100 lg:bg-transparent' : 'lg:text-gray-900 lg:bg-transparent' }} block py-2 px-3 rounded lg:p-0">Billeterie</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'lg:text-indigo-700 text-indigo-700 bg-indigo-100 lg:bg-transparent' : 'lg:text-gray-900 lg:bg-transparent' }} block py-2 px-3 rounded lg:p-0">Contact</a>
                </li>
                <li>
                    <a href="{{ route('faq') }}"
                        class="{{ request()->routeIs('faq') ? 'lg:text-indigo-700 text-indigo-700 bg-indigo-100 lg:bg-transparent' : 'lg:text-gray-900 lg:bg-transparent' }} block py-2 px-3 rounded lg:p-0">Faq</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
