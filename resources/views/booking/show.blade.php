<x-app-layout>
    <x-slot:title>Réservation {{ $booking->ref }}</x-slot:title>

    {{-- status --}}
    @if (session('status'))
    <div class="mx-20 p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <span class="font-medium">{{ session('status') }}</span>
    </div>
    @endif

    @php
        $beneficiaries = json_decode($booking->beneficiaries);
    @endphp
    {{-- billeterie commande --}}
    @if ($booking->type == 'ticketing')
        <div
            class="mx-20 my-10 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="grid gap-4 sm:grid-cols-3">
                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Commande N° : <span class="font-bold">{{ $booking->ref }}</span>
                </h5>

                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Type vol : <span
                        class="font-bold">{{ $booking->ticketing->flight_type === 'AR' ? 'Aller retour' : 'Aller simple' }}</span>
                </h5>

                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Date de création : <span class="font-bold">{{ $booking->created_at }}</span>
                </h5>
            </div>
            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
            <div
                class="bg-gray-100 p-3 rounded-lg mb-6 shadow-md transition-all duration-100 hover:shadow-none hover:bg-gray-50 ">
                <div class="flex items-center ">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                    <span class="text-lg tracking-tight text-gray-900 me-2">Observation :</span>
                    {{ $booking->observation }}
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Aéroport départ : <span class="font-bold">{{ $booking->ticketing->airport_departure }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Aéroport retour : <span class="font-bold">{{ $booking->ticketing->airport_arrived }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Départ : <span class="font-bold">{{ $booking->date_departure }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5
                    class="text-center text-lg tracking-tight text-gray-900 dark:text-white {{ $booking->ticketing->flight_type == 'AS' ? 'hidden' : '' }}">
                    Retour : <span class="font-bold">{{ $booking->date_return }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Compagnie : <span class="font-bold">{{ $booking->ticketing->compagnie }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Class : <span class="font-bold">{{ $booking->ticketing->class }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>


            <div class="mb-4" id="accordion-collapse" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-1 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                        aria-controls="accordion-collapse-body-1">
                        <span>Bénéficiaire(s)</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5 border border-b-1 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        {{-- {{ $booking->beneficiaries }} --}}
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Adulte (s) : <span class="font-bold">{{ $booking->number_adult }}</span>
                            </h5>

                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Enfant (s) : <span class="font-bold">{{ $booking->number_child }}</span>
                            </h5>

                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Bébe (s) : <span class="font-bold">{{ $booking->number_baby }}</span>
                            </h5>
                        </div>
                        <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">

                        @foreach ($beneficiaries->adult as $adult)
                            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Prénom adulte : <span class="font-bold">{{ $adult->fname }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Nom adulte : <span class="font-bold">{{ $adult->lname }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Date de naissance adulte : <span class="font-bold">{{ $adult->dob }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                </h5>
                            </div>
                        @endforeach

                        @if ($beneficiaries->child)
                            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            @foreach ($beneficiaries->child as $child)
                                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Prénom Enfant : <span class="font-bold">{{ $adult->fname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Nom Enfant : <span class="font-bold">{{ $adult->lname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Date de naissance Enfant : <span class="font-bold">{{ $adult->dob }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                    </h5>
                                </div>
                            @endforeach
                        @endif
                        @if ($beneficiaries->baby)
                            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            @foreach ($beneficiaries->baby as $baby)
                                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Prénom Bébe : <span class="font-bold">{{ $adult->fname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Nom Bébe : <span class="font-bold">{{ $adult->lname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Date de naissance Bébe : <span class="font-bold">{{ $adult->dob }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                    </h5>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- trip commande --}}
    @if ($booking->type == 'trip')
        <div
            class="mx-20 my-10 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="grid gap-4 sm:grid-cols-3">
                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Commande N° : <span class="font-bold">{{ $booking->ref }}</span>
                </h5>

                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Montant : <span class="font-bold">{{ $booking->price . '.00 DA' }}</span>
                </h5>

                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Date de création : <span class="font-bold">{{ $booking->created_at }}</span>
                </h5>
            </div>
            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
            <div
                class="bg-gray-100 p-3 rounded-lg mb-6 shadow-md transition-all duration-100 hover:shadow-none hover:bg-gray-50 ">
                <div class="flex items-center ">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                    <span class="text-lg tracking-tight text-gray-900 me-2">Observation :</span>
                    {{ $booking->observation }}
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Destination : <span
                        class="font-bold">{{ $booking->bookingable->destination . ', ' . $booking->bookingable->city }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    @php
                        $diff = date_diff(date_create($booking->date_departure), date_create($booking->date_return));

                    @endphp
                    Durré : <span
                        class="font-bold">{{ $diff->days . ' jours et ' . $diff->days - 1 . 'nuitée' }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Départ : <span class="font-bold">{{ $booking->date_departure }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Retour : <span class="font-bold">{{ $booking->date_return }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    hôtel :
                    <span class="font-bold">
                        {{ $booking->bookingable->hotel->name }}
                        {{ $booking->bookingable->hotel->classification }}
                    </span>
                    <svg class="w-4 h-4 text-yellow-300 ms-1 inline-flex mb-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    formule : <span class="font-bold">{{ $booking->bookingTrip->formule }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

            </div>

            {{-- Bénéficiaire --}}
            <div class="mb-4" id="accordion-collapse" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-1 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                        aria-controls="accordion-collapse-body-1">
                        <span>Bénéficiaire(s)</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5 border border-b-1 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Adulte (s) : <span class="font-bold">{{ $booking->number_adult }}</span>
                            </h5>

                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Enfant (s) : <span class="font-bold">{{ $booking->number_child }}</span>
                            </h5>

                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Bébe (s) : <span class="font-bold">{{ $booking->number_baby }}</span>
                            </h5>
                        </div>
                        <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">

                        @foreach ($beneficiaries->adult as $adult)
                            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Prénom adulte : <span class="font-bold">{{ $adult->fname }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Nom adulte : <span class="font-bold">{{ $adult->lname }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Date de naissance adulte : <span class="font-bold">{{ $adult->dob }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                </h5>
                            </div>
                        @endforeach
                        @if ($beneficiaries->child)
                            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            @foreach ($beneficiaries->child as $child)
                                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Prénom Enfant : <span class="font-bold">{{ $adult->fname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Nom Enfant : <span class="font-bold">{{ $adult->lname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Date de naissance Enfant : <span class="font-bold">{{ $adult->dob }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                    </h5>
                                </div>
                            @endforeach
                        @endif
                        @if ($beneficiaries->baby)
                            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            @foreach ($beneficiaries->baby as $baby)
                                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Prénom Bébe : <span class="font-bold">{{ $adult->fname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Nom Bébe : <span class="font-bold">{{ $adult->lname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Date de naissance Bébe : <span class="font-bold">{{ $adult->dob }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                    </h5>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- hotel commande --}}
    @if ($booking->type === 'hotel')
        <div
            class="mx-20 my-10 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="grid gap-4 sm:grid-cols-3">
                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Commande N° : <span class="font-bold">{{ $booking->ref }}</span>
                </h5>

                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Montant : <span class="font-bold">{{ $booking->price . '.00 DA' }}</span>
                </h5>

                <h5 class="text-2xl tracking-tight text-gray-900 dark:text-white">
                    Date de création : <span class="font-bold">{{ $booking->created_at }}</span>
                </h5>
            </div>
            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
            <div
                class="bg-gray-100 p-3 rounded-lg mb-6 shadow-md transition-all duration-100 hover:shadow-none hover:bg-gray-50 ">
                <div class="flex items-center ">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                    <span class="text-lg tracking-tight text-gray-900 me-2">Observation :</span>
                    {{ $booking->observation }}
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Hôtel situé à : <span
                        class="font-bold">{{ $booking->bookingable->country . ', ' . $booking->bookingable->city }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    @php
                        $diff = date_diff(date_create($booking->date_departure), date_create($booking->date_return));

                    @endphp
                    Durré : <span
                        class="font-bold">{{ $diff->days . ' jours et ' . $diff->days - 1 . 'nuitée' }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Checkin : <span class="font-bold">{{ $booking->date_departure }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    Checkout : <span class="font-bold">{{ $booking->date_return }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    hôtel :
                    <span class="font-bold">
                        {{ $booking->bookingable->name }}
                        {{ $booking->bookingable->classification }}
                    </span>
                    <svg class="w-4 h-4 text-yellow-300 ms-1 inline-flex mb-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

                <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                    formule : <span class="font-bold">{{ $booking->bookingHotel->formule }}</span>
                    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                </h5>

            </div>

            {{-- Bénéficiaire --}}
            <div class="mb-4" id="accordion-collapse" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-1 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                        aria-controls="accordion-collapse-body-1">
                        <span>Bénéficiaire(s)</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5 border border-b-1 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Adulte (s) : <span class="font-bold">{{ $booking->number_adult }}</span>
                            </h5>

                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Enfant (s) : <span class="font-bold">{{ $booking->number_child }}</span>
                            </h5>

                            <h5 class="text-center text-lg tracking-tight text-gray-900 dark:text-white">
                                Bébe (s) : <span class="font-bold">{{ $booking->number_baby }}</span>
                            </h5>
                        </div>
                        <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">

                        @foreach ($beneficiaries->adult as $adult)
                            <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Prénom adulte : <span class="font-bold">{{ $adult->fname }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Nom adulte : <span class="font-bold">{{ $adult->lname }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    Date de naissance adulte : <span class="font-bold">{{ $adult->dob }}</span>
                                </h5>

                                <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                    N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                </h5>
                            </div>
                        @endforeach
                        @if ($beneficiaries->child)
                            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            @foreach ($beneficiaries->child as $child)
                                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Prénom Enfant : <span class="font-bold">{{ $adult->fname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Nom Enfant : <span class="font-bold">{{ $adult->lname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Date de naissance Enfant : <span class="font-bold">{{ $adult->dob }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                    </h5>
                                </div>
                            @endforeach
                        @endif
                        @if ($beneficiaries->baby)
                            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                            @foreach ($beneficiaries->baby as $baby)
                                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Prénom Bébe : <span class="font-bold">{{ $adult->fname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Nom Bébe : <span class="font-bold">{{ $adult->lname }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        Date de naissance Bébe : <span class="font-bold">{{ $adult->dob }}</span>
                                    </h5>

                                    <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                        N° passport : <span class="font-bold">{{ $adult->passport_id }}</span>
                                    </h5>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
