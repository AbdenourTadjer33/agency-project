<x-app-layout>
    <x-slot:title>{{ $hotel->name . ' - Best tour' }}</x-slot:title>

    @php
        $coordinates = $hotel->coordinates;
        if (!is_array($coordinates)) {
            $coordinates = json_decode($coordinates, true);
        }

        $services = $hotel->services;
        if (!is_array($services)) {
            $services = json_decode($services, true);
        }

        $assets = $hotel->assets;
        if (!is_array($assets)) {
            $assets = json_decode($assets, true);
        }
        $formules = [
            'LPD' => 'Petit déjuner',
            'LDP' => 'Demi pension',
            'LPC' => 'Pension compléte',
        ];

        $rooms = ['single', 'double', 'triple', 'quadruple'];
    @endphp

    <style>
        [x-cloak] {
            display: none;
        }

        /* Firefox */
        .image-scroller {
            scrollbar-width: auto;
            scrollbar-color: #1f1f1f;
        }

        /* Chrome, Edge, and Safari */
        .image-scroller::-webkit-scrollbar {
            height: 4px;
        }

        .image-scroller::-webkit-scrollbar-track {
            background: transparent;
        }

        .image-scroller::-webkit-scrollbar-thumb {
            background-color: #1f1f1f;
            border-radius: 0px;
            border: 0px none #bfbfbf;
        }

        .image-scroller::-webkit-scrollbar {
            width: 0px;
            height: 4px;
        }
    </style>


    <div x-data="{ open: false }" class="pb-5">
        <section class="flex flex-col sm:flex-row py-6 px-4 sm:py-10 sm:px-8">
            <div class="w-full mr-0 sm:w-2/5 sm:mr-12">
                <img src="{{ asset('storage/' . $assets[0]['path']) }}" width="100%" x-ref="main" class="rounded-lg"
                    alt="">

                <div class="flex justify-start gap-1 pt-2.5 overflow-auto image-scroller">
                    @foreach ($assets as $asset)
                        <div class="cursor-pointer">
                            <img @click="$refs.main.src = $el.src" src="{{ asset('storage/' . $asset['path']) }}"
                                width="100%" class="h-20 w-20 rounded-sm" alt="">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-full sm:w-1/2 pt-8">
                {{-- <h6 class="uppercase text-xs font-bold text-slate-400 pb-2">{{ $trip->tripCategory->name }}</h6> --}}
                <h2 class="capitalize text-2xl pb-4 text-slate-900 font-bold ">{{ $hotel->name }}</h2>
                {{-- destination --}}
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-slate-900 dark:text-white me-2" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 21">
                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path
                                d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                        </g>
                    </svg>
                    <span class="font-bold">{{ $hotel->address . ', ' . $hotel->city . ', ' . $hotel->country }}</span>
                </div>
                {{-- hotel naem --}}
                <h3 class="text-base text-slate-900 capitalize font-bold flex items-center">
                    <span class="flex items-center ms-4">
                        @for ($i = 0; $i < $hotel->classification; $i++)
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                        @for ($i = 0; $i < 5 - $hotel->classification; $i++)
                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                    </span>
                </h3>
                {{-- pricing --}}
                <h3 class="text-base text-slate-900 capitalize">à partir de <span
                        class="text-slate-900 font-bold">{{ $hotel->pricing->price_adult . 'DA' }}</span></h3>
                {{-- description --}}
                <blockquote
                    class="p-2 my-2 border-s-2 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                    <p class="text-base leading-4 text-gray-900 dark:text-white" x-ref="description" x-transition
                        data-description="{!! $hotel->description !!}" data-mindescription="{!! Str::limit($hotel->description, 70) !!}">
                        {!! Str::limit($hotel->description, 90) !!}
                    </p>
                    <span x-ref="more"
                        x-on:click="$refs.description.innerText = $refs.description.dataset.description; $el.classList.add('hidden'); $refs.less.classList.remove('hidden')"
                        class="more select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Plus
                    </span>
                    <span x-ref="less"
                        x-on:click="$refs.description.innerText = $refs.description.dataset.mindescription; $el.classList.add('hidden'); $refs.more.classList.remove('hidden')"
                        class="less hidden select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Moins
                    </span>
                </blockquote>

            </div>
        </section>

        <div class="text-center">
            <button
                class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                x-on:click="open = true; $el.classList.add('hidden')">Réserve maintenant</button>
        </div>

        <div x-show="open" x-cloak x-transition>
            <div class="mt-5 sm:mx-8 mx-4 bg-gradient-to-tr from-slate-100 via-gray-200 to-neutral-300 ">
                <form class="px-5 py-3 sm:px-10 sm:py-6" id="book-trip" method="post">
                    @csrf
                    @if (!Auth::check())
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <div class="flex items-center justify-center">
                                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <h3 class="text-lg font-medium">Connexion Requise</h3>
                            </div>

                            <div class="text-center">cliqué ici pour <a href="{{ route('login') }}"
                                    class="underline font-medium">s'authentifier</a> ou <a
                                    href="{{ route('register') }}" class="underline font-medium">créer un nouveau
                                    compte</a>.</div>
                        </div>
                    @endif
                    <div class="grid gap-5 mb-4 sm:grid-cols-4">
                        {{-- hotel date check in / check out --}}
                        <div date-rangepicker class="sm:col-span-2 grid gap-5 sm:grid-cols-2"
                            id="container-range-dates">
                            {{-- date depart --}}
                            <div>
                                <label for="date_checkin" class="text-lg font-bold dark:text-white mb-2">
                                    Date Départ (*)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input name="date_checkin" id="date_checkin" type="text" datepicker
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Sélectionnez la date de départ">
                                </div>
                                @error('date_checkin')
                                    <div class="text-red-800 error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- date return --}}
                            <div>
                                <label for="date_checkout" class="text-lg font-bold dark:text-white mb-2">
                                    Date Retour (*)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input name="date_checkout" id="date_checkout" type="text" datepicker
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Sélectionnez la date de retour">
                                </div>
                                @error('date_checkout')
                                    <div class="text-red-800 error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- hotel formula --}}
                        <div>
                            <label for="formule" class="text-lg font-bold dark:text-white mb-2">Selectionnez
                                Formule</label>
                            <select id="formule" name="formule"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($formules as $key => $value)
                                    <option {{ old('formule') == $key ? 'selected' : '' }}
                                        value="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            @error('formule')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- montant --}}
                        <div>
                            <h4 class="text-lg font-bold dark:text-white">Montant: </h4>
                            <div id="price"
                                class="text-center justify-center items-center text-2xl font-extrabold pb-2.5 text-slate-800 ">
                                <div class="h-6 rounded-full bg-gray-200 w-1/2 mt-2 ms-10 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Benifiants counts --}}
                    <h4 class="text-2xl font-bold dark:text-white mb-2">Bénéficiaire(s)</h4>
                    <div class="grid gap-5 mb-4 sm:grid-cols-3">
                        {{-- nb_adult --}}
                        <div>
                            <label for="nb-adult" class="block mb-2 text-sm font-medium text-gray-900">
                                Nombre Adulte(s) (*)
                            </label>
                            <select id="nb-adult" name="nb_adult"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option {{ old('nb_adult') == $i ? 'selected' : '' }}
                                        value="{{ $i }}">
                                        {{ $i }} {{ $i > 1 ? 'Adultes' : 'Adulte' }} </option>
                                @endfor
                            </select>
                            @error('nb_adult')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- nb_child --}}
                        <div>
                            <label for="nb-child" class="block mb-2 text-sm font-medium text-gray-900">
                                Nombre Enfant(s) <span class="text-xs">(âge 2-11 ans)</span> (*)
                            </label>
                            <select id="nb-child" name="nb_child"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @for ($i = 0; $i <= 5; $i++)
                                    <option {{ old('nb_child') == $i ? 'selected' : '' }}
                                        value="{{ $i }}">
                                        {{ $i }} {{ $i > 1 ? 'Enfants' : 'Enfant' }}</option>
                                @endfor
                            </select>
                            @error('nb_child')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- nb_baby --}}
                        <div>
                            <label for="nb-baby" class="block mb-2 text-sm font-medium text-gray-900">
                                Nombre Bébé(s) <span class="text-xs">(âge 0-23 mois)</span> (*)
                            </label>
                            <select id="nb-baby" name="nb_baby" value="{{ old('nb_baby') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @for ($i = 0; $i <= 5; $i++)
                                    <option {{ old('nb_baby') == $i ? 'selected' : '' }} value="{{ $i }}">
                                        {{ $i }} {{ $i > 1 ? 'Bébes' : 'Bébe' }}</option>
                                @endfor
                            </select>
                            @error('nb_baby')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Benifiants informations --}}
                    <div class="bg-slate-50 px-4 py-8 mb-4 rounded-lg">
                        {{-- checkbox ticket for me --}}
                        <div class="flex items-center sm:col-span-4 mb-4">
                            <input id="for_me" name="for_me" type="checkbox"
                                {{ Auth::check() ? '' : 'disabled' }}
                                data-fname="{{ Auth::check() ? Auth::user()->first_name : null }}"
                                data-lname="{{ Auth::check() ? Auth::user()->last_name : null }}"
                                data-dob="{{ Auth::check() ? Auth::user()->dob : null }}"
                                data-id="{{ Auth::check() ? Auth::user()->passport_id : null }}"
                                class=" disabled:bg-gray-300 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="for_me"
                                class="select-none ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                                Je réserve pour moi.
                            </label>
                        </div>
                        {{-- adults info --}}
                        <div class="grid gap-5 mb-4 sm:grid-cols-4" id="container-info-adult">
                            @if (old('adult') > 0)
                                @foreach (old('adult') as $key => $value)
                                    @php
                                        $errorFname = 'adult.' . $key . '.fname';
                                        $errorLname = 'adult.' . $key . '.lname';
                                        $errorDob = 'adult.' . $key . '.dob';
                                        $errorId = 'adult.' . $key . '.passport_id';
                                    @endphp
                                    {{-- fname --}}
                                    <div>
                                        <label for="adult[{{ $key }}][fname]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Prénom Adulte (*)
                                        </label>
                                        <input type="text" id="adult[{{ $key }}][fname]"
                                            name="adult[{{ $key }}][fname]" value="{{ $value['fname'] }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorFname)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- lname --}}
                                    <div>
                                        <label for="adult[{{ $key }}][lname]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Nom Adulte (*)
                                        </label>
                                        <input type="text" id="adult[{{ $key }}][lname]"
                                            name="adult[{{ $key }}][lname]" value="{{ $value['lname'] }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorLname)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- dob --}}
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">
                                            Date de naissance Adulte (*)
                                        </label>
                                        <div class="relative ">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker datepicker-format="yyyy-mm-dd"
                                                datepicker-orientation="bottom" type="text"
                                                id="adult[{{ $key }}][dob]"
                                                name="adult[{{ $key }}][dob]" value="{{ $value['dob'] }}"
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="sélectionner une date">
                                        </div>
                                        @error($errorDob)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- passport id --}}
                                    <div>
                                        <label for="adult[0][passport_id]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Passeport N° (*)
                                        </label>
                                        <input type="text" id="adult[0][passport_id]" name="adult[0][passport_id]"
                                            value="{{ old('adult.0.passport_id') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorId)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            @else
                                {{-- fname --}}
                                <div>
                                    <label for="adult[0][fname]" class="block mb-2 text-sm font-medium text-gray-900">
                                        Prénom Adulte (*)
                                    </label>
                                    <input type="text" id="adult[0][fname]" name="adult[0][fname]"
                                        value="{{ old('adult.0.fname') }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @error('adult.0.fname')
                                        <div class="text-red-800 error">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- lname --}}
                                <div>
                                    <label for="adult[0][lname]" class="block mb-2 text-sm font-medium text-gray-900">
                                        Nom Adulte (*)
                                    </label>
                                    <input type="text" id="adult[0][lname]" name="adult[0][lname]"
                                        value="{{ old('adult.0.lname') }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @error('adult.0.lname')
                                        <div class="text-red-800 error">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- dob --}}
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">
                                        Date de naissance Adulte (*)
                                    </label>
                                    <div class="relative ">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-format="yyyy-mm-dd"
                                            datepicker-orientation="bottom" type="text" id="adult[0][dob]"
                                            name="adult[0][dob]" value="{{ old('adult.0.dob') }}"
                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="sélectionner une date">
                                    </div>
                                    @error('adult.0.dob')
                                        <div class="text-red-800 error">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- passport id --}}
                                <div>
                                    <label for="adult[0][passport_id]"
                                        class="block mb-2 text-sm font-medium text-gray-900">
                                        Passeport N° (*)
                                    </label>
                                    <input type="text" id="adult[0][passport_id]" name="adult[0][passport_id]"
                                        value="{{ old('adult.0.passport_id') }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @error('adult.0.passport_id')
                                        <div class="text-red-800 error">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        {{-- childs info --}}
                        <div class="grid gap-5 mb-4 sm:grid-cols-4 {{ old('child') > 0 ? '' : 'hidden' }}"
                            id="container-info-child">
                            @if (old('child') > 0)
                                @foreach (old('child') as $key => $value)
                                    @php
                                        $errorFname = 'child.' . $key . '.fname';
                                        $errorLname = 'child.' . $key . '.lname';
                                        $errorDob = 'child.' . $key . '.dob';
                                        $errorId = 'child.' . $key . '.passport_id';
                                    @endphp
                                    {{-- fname --}}
                                    <div>
                                        <label for="child[{{ $key }}][fname]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Prénom Enfant (*)
                                        </label>
                                        <input type="text" id="child[{{ $key }}][fname]"
                                            name="child[{{ $key }}][fname]" value="{{ $value['fname'] }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorFname)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- lname --}}
                                    <div>
                                        <label for="chld[{{ $key }}][lname]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Nom Enfant (*)
                                        </label>
                                        <input type="text" id="child[{{ $key }}][lname]"
                                            name="child[{{ $key }}][lname]" value="{{ $value['lname'] }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorLname)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- dob --}}
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">
                                            Date de naissance Enfant (*)
                                        </label>
                                        <div class="relative ">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker datepicker-format="yyyy-mm-dd"
                                                datepicker-orientation="bottom" type="text"
                                                name="child[{{ $key }}][dob]" value="{{ $value['dob'] }}"
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="sélectionner une date">
                                        </div>
                                        @error($errorDob)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- passport id --}}
                                    <div>
                                        <label for="child[0][passport_id]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Passeport N° (*)
                                        </label>
                                        <input type="text" id="child[0][passport_id]" name="child[0][passport_id]"
                                            value="{{ old('adult.0.passport_id') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorId)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- babys info --}}
                        <div class="grid gap-5 sm:grid-cols-4 {{ old('baby') > 0 ? '' : 'hidden' }}"
                            id="container-info-baby">
                            @if (old('baby') > 0)
                                @foreach (old('baby') as $key => $value)
                                    @php
                                        $errorFname = 'baby.' . $key . '.fname';
                                        $errorLname = 'baby.' . $key . '.lname';
                                        $errorDob = 'baby.' . $key . '.dob';
                                        $errorId = 'baby.' . $key . '.passport_id';
                                    @endphp
                                    {{-- fname --}}
                                    <div>
                                        <label for="baby[{{ $key }}][fname]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Prénom Bébe (*)
                                        </label>
                                        <input type="text" id="baby[{{ $key }}][fname]"
                                            name="baby[{{ $key }}][fname]" value="{{ $value['fname'] }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorFname)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- lname --}}
                                    <div>
                                        <label for="baby[{{ $key }}][lname]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Nom Bébe (*)
                                        </label>
                                        <input type="text" id="baby[{{ $key }}][lname]"
                                            name="baby[{{ $key }}][lname]" value="{{ $value['lname'] }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorFname)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- dob --}}
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">
                                            Date de naissance Bébe (*)
                                        </label>
                                        <div class="relative ">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker datepicker-format="yyyy-mm-dd"
                                                datepicker-orientation="bottom" type="text"
                                                name="baby[{{ $key }}][dob]" value="{{ $value['dob'] }}"
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="sélectionner une date">
                                        </div>
                                        @error($errorDob)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- passport id --}}
                                    <div>
                                        <label for="baby[0][passport_id]"
                                            class="block mb-2 text-sm font-medium text-gray-900">
                                            Passeport N° (*)
                                        </label>
                                        <input type="text" id="baby[0][passport_id]" name="baby[0][passport_id]"
                                            value="{{ old('baby.0.passport_id') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error($errorId)
                                            <div class="text-red-800 error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- observation --}}
                    <div class="grid gap-5 sm:grid-cols-1 mb-4">
                        <div>
                            <label for="message" class="text-2xl font-bold dark:text-white">Observation(s)</label>
                            <textarea id="message" name="message" rows="4"
                                class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Vous pouvez écrire des remarques ici ..."></textarea>
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <button type="submit"
                            class="w-full text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Réserver
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>





    <script>
        window.onload = function() {
            function createInputLabelContainer(placeholder, name, id) {
                // containerEl
                const containerEl = document.createElement("div");

                // labelEl
                const labelEl = document.createElement("label");
                labelEl.classList = "block mb-2 text-sm font-medium text-gray-900";
                labelEl.setAttribute("for", id);
                labelEl.innerText = placeholder;

                // inputEl
                const inputEl = document.createElement("input");
                inputEl.classList =
                    "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5";
                inputEl.setAttribute("type", "text");
                inputEl.setAttribute("id", id);
                inputEl.setAttribute("name", name);

                containerEl.append(labelEl, inputEl);
                return containerEl;
            }

            function createDateInputLabelContainer(placeholder, name) {
                // containerEl
                const containerEl = document.createElement("div");

                // labelEl
                const labelEl = document.createElement("label");
                labelEl.classList = "block mb-2 text-sm font-medium text-gray-900";
                labelEl.innerText = placeholder;

                const div = document.createElement("div");
                div.innerHTML =
                    `<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none"><svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" /></svg></div>`;
                div.classList = "relative";

                const dateInput = document.createElement("input");
                dateInput.classList =
                    "bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
                dateInput.setAttribute("datepicker", "");
                dateInput.setAttribute("type", "text");
                dateInput.setAttribute("name", name);
                dateInput.setAttribute("id", name);
                dateInput.setAttribute("placeholder", "Sélectionner une date");

                const customEvent = new CustomEvent("new-datepicker", {
                    detail: {
                        element: dateInput,
                    },
                });
                document.dispatchEvent(customEvent);

                div.append(dateInput);
                containerEl.append(labelEl, div);
                return containerEl;
            }

            async function calculateNewPrice() {
                const $priceEl = document.querySelector('#price');
                try {
                    const response = await axios.post('/api/hotel/{{ $hotel->slug }}/calculate-price', {
                        formule: form.querySelector("#formule").value,
                        countAdult: form.querySelector("#nb-adult").value,
                        countChild: form.querySelector("#nb-child").value,
                        countBaby: form.querySelector("#nb-baby").value,
                        formule: form.querySelector('#formule').value
                    });

                    if (response.status === 200) {
                        const data = response.data;
                        $priceEl.innerText = data.data.price + ' DA';
                    }
                } catch (error) {
                    console.log(error);
                }
            }

            setTimeout(() => {
                calculateNewPrice();
            }, 2000);

            const form = document.querySelector("form#book-trip");
            const dateId = form.querySelector("#date_id");
            const formule = form.querySelector("#formule");
            const adultCount = form.querySelector("#nb-adult");
            const childCount = form.querySelector("#nb-child");
            const babyCount = form.querySelector("#nb-baby");
            const checkForMe = form.querySelector("#for_me");

            // checkbox => trip for user
            checkForMe.onchange = (event) => {
                const fnameField = document.getElementById("adult[0][fname]");
                const lnameField = document.getElementById("adult[0][lname]");
                const dobField = document.getElementById("adult[0][dob]");
                const idField = document.getElementById("adult[0][passport_id]");

                if (checkForMe.checked) {
                    fnameField.value = checkForMe.getAttribute("data-fname");
                    lnameField.value = checkForMe.getAttribute("data-lname");
                    dobField.value = checkForMe.getAttribute("data-dob");
                    idField.value = checkForMe.getAttribute("data-id");
                } else {
                    fnameField.value = "";
                    lnameField.value = "";
                    dobField.value = "";
                    idField.value = "";
                }
            };

            adultCount.onchange = (event) => {
                const len = adultCount.value;
                form.querySelector("#container-info-adult").innerHTML = "";
                for (let i = 0; i < len; i++) {
                    const fnameContainer = createInputLabelContainer(
                        "Prénom Adulte (*)",
                        `adult[${i}][fname]`,
                        `adult[${i}][fname]`
                    );
                    const lnameContainer = createInputLabelContainer(
                        "Nom Adulte (*)",
                        `adult[${i}][lname]`,
                        `adult[${i}][lname]`
                    );
                    const dobContainer = createDateInputLabelContainer(
                        "Date de naissance Adulte (*)",
                        `adult[${i}][dob]`
                    );
                    const idContainer = createInputLabelContainer(
                        "Passeport N° (*)",
                        `adult[${i}][passport_id]`,
                        `adult[${i}][passport_id]`
                    );

                    form.querySelector("#container-info-adult").append(
                        fnameContainer,
                        lnameContainer,
                        dobContainer,
                        idContainer
                    );
                }

                if (checkForMe.checked) {
                    const fnameField = document.getElementById("adult[0][fname]");
                    const lnameField = document.getElementById("adult[0][lname]");
                    const dobField = document.getElementById("adult[0][dob]");
                    const idField = document.getElementById("adult[0][passport_id]");
                    fnameField.value = checkForMe.getAttribute("data-fname");
                    lnameField.value = checkForMe.getAttribute("data-lname");
                    dobField.value = checkForMe.getAttribute("data-dob");
                    idField.value = checkForMe.getAttribute("data-id");
                }

                calculateNewPrice();
            };

            childCount.onchange = (event) => {
                const len = childCount.value;
                if (len > 0) form.querySelector("#container-info-child").classList.remove("hidden");
                if (len == 0) form.querySelector("#container-info-child").classList.add("hidden");
                form.querySelector("#container-info-child").innerHTML = "";
                for (let i = 0; i < len; i++) {
                    const fnameContainer = createInputLabelContainer(
                        "Prénom Enfant (*)",
                        `child[${i}][fname]`,
                        `child[${i}][fname]`
                    );
                    const lnameContainer = createInputLabelContainer(
                        "Nom Enfant (*)",
                        `child[${i}][lname]`,
                        `child[${i}][lname]`
                    );
                    const dobContainer = createDateInputLabelContainer(
                        "Date de naissance Enfant (*)",
                        `child[${i}][dob]`
                    );
                    const idContainer = createInputLabelContainer(
                        "Passeport N° (*)",
                        `child[${i}][passport_id]`,
                        `child[${i}][passport_id]`
                    );

                    form.querySelector("#container-info-child").append(
                        fnameContainer,
                        lnameContainer,
                        dobContainer,
                        idContainer
                    );
                }

                calculateNewPrice();
            };

            babyCount.onchange = (event) => {
                const len = babyCount.value;
                if (len > 0) form.querySelector("#container-info-baby").classList.remove("hidden");
                if (len == 0) form.querySelector("#container-info-baby").classList.add("hidden");
                form.querySelector("#container-info-baby").innerHTML = "";
                for (let i = 0; i < len; i++) {
                    const fnameContainer = createInputLabelContainer(
                        "Prénom Bébe (*)",
                        `baby[${i}][fname]`,
                        `baby[${i}][fname]`
                    );
                    const lnameContainer = createInputLabelContainer(
                        "Nom Bébe (*)",
                        `baby[${i}][lname]`,
                        `baby[${i}][lname]`
                    );
                    const dobContainer = createDateInputLabelContainer(
                        "Date de naissance Bébe (*)",
                        `baby[${i}][dob]`
                    );
                    const idContainer = createInputLabelContainer(
                        "Passeport N° (*)",
                        `baby[${i}][passport_id]`,
                        `baby[${i}][passport_id]`
                    );
                    form.querySelector("#container-info-baby").append(
                        fnameContainer,
                        lnameContainer,
                        dobContainer,
                        idContainer
                    );
                }

                calculateNewPrice();
            };

            formule.onchange = event => {
                calculateNewPrice();
            }
        }

        function showMore(event) {
            const parentNode = event.target.parentNode;
            const descriptionEl = parentNode.querySelector('.field');
            const allDescription = descriptionEl.getAttribute('data-all');

            event.target.classList.add('hidden');
            descriptionEl.innerText = allDescription;

            parentNode.querySelector('.less').classList.remove('hidden')
        }

        function showLess(event) {
            const parentNode = event.target.parentNode;
            const descriptionEl = parentNode.querySelector('.field');
            const description = descriptionEl.getAttribute('data-less');

            event.target.classList.add('hidden');
            descriptionEl.innerText = description;

            parentNode.querySelector('.more').classList.remove('hidden')

        }
    </script>

</x-app-layout>
