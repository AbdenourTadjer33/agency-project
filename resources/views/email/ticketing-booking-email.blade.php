@php
    $beneficiaries = $booking->beneficiaries;
    if (!is_array($beneficiaries)) {
        $beneficiaries = json_decode($booking->beneficiaries, true);
    }
@endphp
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demande de réservation {{ $booking->ref }} prise en charge</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'figtree', sans-serif;
        }

        /* Banner styles */
        .banner {
            background-image: linear-gradient(#3F83F8c0, #3b82f6c0), url(https://sagimexpro.dz/assets/banners/email-bg.png);
        }

        /* Header styles */
        h1 {
            font-size: 1.25rem;
            font-weight: 500;
            color: #ffffff;
        }

        /* Grid styles */
        .grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            grid-gap: 1rem;
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        /* Typography styles */
        .text-xs {
            font-size: 0.75rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-base {
            font-size: 1rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        /* Link styles */
        a {
            color: #3b82f6;
            text-decoration: underline;
        }

        a:hover {
            color: #2563eb;
        }

        /* Border styles */
        .border {
            border-width: 1px;
            border-style: solid;
        }

        .border-b-1 {
            border-bottom-width: 1px;
        }

        .border-gray-300 {
            border-color: #d1d5db;
        }

        .border-0 {
            border-width: 0;
        }

        /* Background styles */
        .bg-gray-100 {
            background-color: #f3f4f6;
        }

        .bg-gray-200 {
            background-color: #e5e7eb;
        }

        .bg-gray-900 {
            background-color: #1f2937;
        }

        .bg-gradient-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
        }

        /* Spacing styles */
        .p-4 {
            padding: 1rem;
        }

        .p-5 {
            padding: 1.25rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .my-6 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Flex styles */
        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .justify-between {
            justify-content: space-between;
        }

        .items-center {
            align-items: center;
        }

        /* Hidden styles */
        .hidden {
            display: none;
        }

        /* Horizontal rule styles */
        .hr {
            border: none;
            height: 1px;
            background-color: #e5e7eb;
        }

        /* Dark mode styles */
        .dark {
            color: #ffffff;
        }

        .dark:border-gray-700 {
            border-color: #4b5563;
        }
    </style>
</head>
<style>
    .banner {
        background-image: linear-gradient(#3F83F8c0, #3b82f6c0), url(https://sagimexpro.dz/assets/banners/email-bg.png);
    }
</style>

<body>
    {{--  --}}
    <div style="w-full h-full">
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 flex flex-col items-center p-4 banner">
            <img class=" w-12" src="https://sagimexpro.dz/assets/icons/check-circle.png" />
            <h1 class="pt-4 text-xs font-medium text-gray-100">Demande de réservation {{ $booking->ref }} prise en
                charge.</h1>
        </div>
        <div class="px-4 py-4 sm:px-8 bg-gray-100">
            {{-- informations --}}
            <div class="grid gap-4 mb-4 lg:grid-cols-3">
                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Commande N° : <a href="{{ route('booking.show', ['ref' => $booking->ref]) }}"
                        class="font-bold text-blue-700 underline">{{ $booking->ref }}</a>
                </h5>
                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Type vol : <span
                        class="font-bold">{{ $bookingTicketing->flight_type === 'AR' ? 'Aller retour' : 'Aller simple' }}</span>
                </h5>
                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Date de création : <span class="font-bold">{{ $booking->created_at }}</span>
                </h5>
                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Aéroport départ : <span class="font-bold">{{ $bookingTicketing->airport_departure }}</span>
                </h5>

                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Aéroport retour : <span class="font-bold">{{ $bookingTicketing->airport_arrived }}</span>
                </h5>
                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Départ : <span class="font-bold">{{ $booking->date_departure }}</span>
                </h5>
                <h5
                    class="text-lg tracking-tight text-gray-900 dark:text-white {{ $bookingTicketing->flight_type == 'AS' ? 'hidden' : '' }}">
                    Retour : <span class="font-bold">{{ $booking->date_return }}</span>
                </h5>
                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Compagnie : <span class="font-bold">{{ $bookingTicketing->compagnie }}</span>
                </h5>

                <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                    Class : <span class="font-bold">{{ $bookingTicketing->class }}</span>
                </h5>
            </div>

            {{-- {{ $booking->beneficiaries }} --}}
            <div class="p-5 border border-b-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                <div class="flex justify-between ">

                    <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                        Adulte (s) : <span class="font-bold">{{ $booking->number_adult }}</span>
                    </h5>

                    <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                        Enfant (s) : <span class="font-bold">{{ $booking->number_child }}</span>
                    </h5>

                    <h5 class="text-lg tracking-tight text-gray-900 dark:text-white">
                        Bébe (s) : <span class="font-bold">{{ $booking->number_baby }}</span>
                    </h5>
                </div>
                <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                @foreach ($beneficiaries['adult'] as $adult)
                    <div class="grid gap-4 mb-4 sm:grid-cols-4">
                        <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                            Prénom adulte : <span class="font-bold">{{ $adult['fname'] }}</span>
                        </h5>

                        <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                            Nom adulte : <span class="font-bold">{{ $adult['lname'] }}</span>
                        </h5>

                        <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                            Date de naissance adulte : <span class="font-bold">{{ $adult['dob'] }}</span>
                        </h5>

                        <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                            N° passport : <span class="font-bold">{{ $adult['passport_id'] }}</span>
                        </h5>
                    </div>
                @endforeach
                @if ($beneficiaries['child'])
                    <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                    @foreach ($beneficiaries['child'] as $child)
                        <div class="grid gap-4 mb-4 sm:grid-cols-4">
                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                Prénom Enfant : <span class="font-bold">{{ $child['fname'] }}</span>
                            </h5>

                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                Nom Enfant : <span class="font-bold">{{ $child['lname'] }}</span>
                            </h5>

                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                Date de naissance Enfant : <span class="font-bold">{{ $child['dob'] }}</span>
                            </h5>

                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                N° passport : <span class="font-bold">{{ $child['passport_id'] }}</span>
                            </h5>
                        </div>
                    @endforeach
                @endif
                @if ($beneficiaries['baby'])
                    <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-700">
                    @foreach ($beneficiaries['baby'] as $baby)
                        <div class="grid gap-4 mb-4 sm:grid-cols-4">
                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                Prénom Bébe : <span class="font-bold">{{ $baby['fname'] }}</span>
                            </h5>

                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                Nom Bébe : <span class="font-bold">{{ $baby['lname'] }}</span>
                            </h5>

                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                Date de naissance Bébe : <span class="font-bold">{{ $baby['dob'] }}</span>
                            </h5>

                            <h5 class="text-base tracking-tight text-gray-900 dark:text-white">
                                N° passport : <span class="font-bold">{{ $baby['passport_id'] }}</span>
                            </h5>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div
            class="bg-gradient-to-r from-cyan-500 to-blue-500 p-5 text-xs font-medium text-gray-100 flex justify-center items-center">
            <a href="{{ route('welcome') }}" class="underline">{{ route('welcome') }}</a>
        </div>
    </div>
</body>

</html>
