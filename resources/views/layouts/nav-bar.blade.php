{{-- website navbar --}}
<nav id="navbar" class="flex justify-between items-center w-full bg-gray-50 py-2 px-5 z-50">
    <div>
        <a href="/"><x-application-logo class="w-20 h-20 fill-current text-gray-500" /></a>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-link :href="route('welcome')" :active="request()->routeIs('welcome')">
            {{ __('Accueil') }}
        </x-link>

        <x-link :href="route('trips')" :active="request()->routeIs('trips')">
            {{ __('Voyages') }}
        </x-link>

        <x-link :href="route('hotels')" :active="request()->routeIs('hotels')">
            {{ __('Hotels') }}
        </x-link>

        <x-link :href="route('ticketing')" :active="request()->routeIs('ticketing')">
            {{ __('Billeterie') }}
        </x-link>

        <x-link :href="route('contact')" :active="request()->routeIs('contact')">
            {{ __('Contact') }}
        </x-link>
    </div>
</nav>
