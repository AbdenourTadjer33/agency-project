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

<div class="bg-gradient-to-r from-cyan-500 to-blue-500 w-full h-16 py-2 px-5 flex justify-between">
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

    <div class="flex">
        @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->first_name . '+' . Auth::user()->last_name }}"
                            class="rounded-full w-8 mr-3" alt="avatar">
                        <div>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
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
            <div class="mr-2">
                <button class="bg-sky-500 py-2 px-4 rounded">
                    <a href="{{ route('login') }}">Login</a>
                </button>
            </div>
            <div>
                <button class="bg-sky-500 py-2 px-4 rounded">
                    <a href="{{ route('register') }}">Register</a>
                </button>
            </div>
        @endauth
    </div>

</div>
