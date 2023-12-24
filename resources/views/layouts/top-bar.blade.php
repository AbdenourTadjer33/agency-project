{{-- top bar website --}}
@php
    $agence = Storage::json('private/Agency.json');
    $networks = $agence['networks'];
    $coordinates = $agence['coordinates'];
    $phones = [];
    $emails = [];
    foreach ($coordinates as $value) {
        $phones[] = $value['phone'];
        $emails[] = $value['email'];
    }

    $logos = [
        'instagram' => asset('storage/icons/instagram-logo.svg'),
        'facebook' => asset('storage/icons/facebook-logo.svg'),
        'whatsapp' => asset('storage/icons/whatsapp-logo.svg'),
        'linkedin' => asset('storage/icons/linkedin-logo.svg'),
    ];
@endphp

<div class="bg-gradient-to-r from-cyan-500 to-blue-500 w-full h-16 py-2 px-5 flex items-center justify-between">
    <div class="flex items-center">
        <ul class="flex items-center">
            <li><img src="{{ asset('storage/icons/phone.svg') }}"></li>
            <li>{{ $phones[0] }}</li>
            <span class="px-2">|</span>
            <li>{{ $phones[1] }}</li>
        </ul>
        <div class="ml-2 flex">
            @foreach ($networks as $network => $link)
                <a href="{{ $link }}">
                    <img src="{{ $logos[$network] }}" alt="{{ $network }} logo">
                </a>
            @endforeach
        </div>
    </div>

    <div>
        @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 px-3 py-2 border border-transparent text-sm leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <span class="font-medium text-gray-600 dark:text-gray-300 ">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                        </span>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    @if (Auth::user()->isAdmin())
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                    @endif
                    <x-dropdown-link :href="route('bookings')">
                        {{ __('Mes réservations') }}
                    </x-dropdown-link>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @else
            <div class="flex gap-2">
                <a href="{{ route('login') }}">
                    <button class="bg-sky-500 py-2 px-4 rounded-lg w-32 text-sm text-gray-800 hover:bg-sky-600">
                        Login
                    </button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="bg-sky-500 py-2 px-4 rounded-lg w-32 text-sm text-gray-800 hover:bg-sky-600">
                        Register
                    </button>
                </a>
            </div>
        @endauth
    </div>

</div>
