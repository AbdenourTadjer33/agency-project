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

<footer class="bg-gray-100 mt-5 px-5">
    <div class=" w-full py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            {{-- logo --}}
            <div class="mb-6 md:mb-0">
                <a href="/"><x-application-logo class="w-20 h-20 fill-current text-gray-500" /></a>
            </div>

            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-4">
                {{-- phones --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                        Nous contacter
                        {{-- @dump($phones) --}}
                    </h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        @foreach ($phones as $phone)
                            <li class="mb-4">
                                <a href="tel:{{ $phone }}" class="hover:underline">{{ $phone }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- network links --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                        Suivez-nous
                    </h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        @foreach ($networks as $network => $link)
                        <li class="mb-4">
                            <a href="{{ $link }}" class="hover:underline">{{ $network }}</a>
                        </li>                            
                        @endforeach
                    </ul>
                </div>
                {{-- Menu --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Menu</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="/" class="hover:underline">Accueil</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('trips') }}" class="hover:underline">Nos Voyages</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('hotels') }}" class="hover:underline">Nos Hôtels</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('ticketing') }}" class="hover:underline">Billeterie</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>
                {{-- important links --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Politique de Confidentialité</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Termes &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="mb-6 mt-2 border-gray-200 sm:mx-auto dark:border-gray-700" />
        <div class="sm:flex sm:items-center sm:justify-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ now()->year }} <a
                    href="/" class="hover:underline">Best tour Algérie™</a>. All Rights Reserved.
            </span>
        </div>
    </div>
</footer>
