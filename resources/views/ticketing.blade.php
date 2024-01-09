<x-app-layout>
    <x-slot:title>Billeterie</x-slot:title>
    <x-slot:script>{{ asset('storage/js/ticketing.js') }}</x-slot:script>

    <div class="mx-8 my-10 bg-gradient-to-tr from-slate-100 via-gray-200 to-neutral-300 ">
        <form class="px-10 py-6" id="ticketing" method="post">
            @csrf
            {{-- flight type --}}
            <h4 class="text-2xl font-bold dark:text-white mb-2">Type Vol</h4>
            <div class="w-1/3 mb-4">
                <label for="flight_type" class="block mb-2 text-sm font-medium text-gray-900">
                    Type Vol (*)
                </label>
                <select id="flight_type" name="flight_type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option {{ old('flight_type') === 'AS' ? 'selected' : '' }} value="AS">Aller simple</option>
                    <option {{ old('flight_type') === 'AR' ? 'selected' : '' }} value="AR">Aller retour</option>
                </select>
                @error('flight_type')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- details vol --}}
            <h4 class="text-2xl font-bold dark:text-white mb-2">Détail Vol</h4>
            <div class="grid gap-5 mb-4 sm:grid-cols-4">
                {{-- airport departure --}}
                <div>
                    <label for="airport_departure" class="block mb-2 text-sm font-medium text-gray-900">
                        Aéroport de départ (*)
                    </label>
                    <input type="text" id="airport_departure" name="airport_departure"
                        value="{{ old('airport_departure') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('airport_departure')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- airport arrived --}}
                <div>
                    <label for="airport_arrived" class="block mb-2 text-sm font-medium text-gray-900">
                        Aéroport d'arrivée (*)
                    </label>
                    <input type="text" id="airport_arrived" name="airport_arrived"
                        value="{{ old('airport_arrived') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('airport_arrived')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- class --}}
                <div>
                    <label for="class" class="block mb-2 text-sm font-medium text-gray-900">
                        Classe (*)
                    </label>
                    <select id="class" name="class"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Pas de préférence">Pas de préférence</option>
                        <option value="Economie">Economie</option>
                        <option value="Affaires">Affaires</option>
                        <option value="Première">Première</option>
                    </select>
                    @error('class')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- compagnie --}}
                <div>
                    <label for="compagnie" class="block mb-2 text-sm font-medium text-gray-900">
                        Compagnie (*)
                    </label>
                    <select id="compagnie" name="compagnie"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Pas de préférence">Pas de préférence</option>
                        <option value="Air Algérie">Air Algérie</option>
                        <option value="Tunisair">Tunisair</option>
                        <option value="Royal Air Maroc">Royal Air Maroc</option>
                        <option value="Turkish Airlines">Turkish Airlines</option>
                    </select>
                    @error('compagnie')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- date departure --}}
                <div id="date-departure"
                    class="{{ old('flight_type') && old('flight_type') !== 'AS' ? 'hidden' : '' }}">
                    <label for="only_departure" class="block mb-2 text-sm font-medium text-gray-900">
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
                        <input datepicker type="text" name="only_departure" id="only_departure"
                            value="{{ old('only_departure') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Sélectionnez la date de départ">
                    </div>
                    @error('only_departure')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- date departure & return --}}
                <div class="sm:col-span-3">
                    {{-- range departure & return --}}
                    <div date-rangepicker
                        class="grid gap-5 sm:grid-cols-3 {{ old('flight_type') && old('flight_type') == 'AR' ? '' : 'hidden' }}"
                        id="container-range-dates">
                        {{-- date depart --}}
                        <div>
                            <label for="date_departure" class="block mb-2 text-sm font-medium text-gray-900">
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
                                <input name="date_departure" id="date_departure" type="text" datepicker
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sélectionnez la date de départ">
                            </div>
                            @error('date_departure')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- date return --}}
                        <div>
                            <label for="date_return" class="block mb-2 text-sm font-medium text-gray-900">
                                Date Retour (*)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="date_return" id="date_return" type="text" datepicker
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sélectionnez la date de retour">
                            </div>
                            @error('date_return')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>
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
                            <option {{ old('nb_adult') == $i ? 'selected' : '' }} value="{{ $i }}">
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
                            <option {{ old('nb_child') == $i ? 'selected' : '' }} value="{{ $i }}">
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
                    <input id="for_me" name="for_me" type="checkbox" {{ Auth::check() ? '' : 'disabled' }}
                        data-fname="{{ Auth::check() ? Auth::user()->first_name : null }}"
                        data-lname="{{ Auth::check() ? Auth::user()->last_name : null }}"
                        data-dob="{{ Auth::check() ? Auth::user()->dob : null }}"
                        data-id="{{ Auth::check() ? Auth::user()->passport_id : null }}"
                        class=" disabled:bg-gray-300 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="for_me"
                        class="select-none ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                        Je demande ce billet pour moi.
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
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom"
                                        type="text" id="adult[{{ $key }}][dob]" name="adult[{{ $key }}][dob]"
                                        value="{{ $value['dob'] }}"
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
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom"
                                    type="text" id="adult[0][dob]" name="adult[0][dob]" value="{{ old('adult.0.dob') }}"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="sélectionner une date">
                            </div>
                            @error('adult.0.dob')
                                <div class="text-red-800 error">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- passport id --}}
                        <div>
                            <label for="adult[0][passport_id]" class="block mb-2 text-sm font-medium text-gray-900">
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
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom"
                                        type="text" name="child[{{ $key }}][dob]"
                                        value="{{ $value['dob'] }}"
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
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom"
                                        type="text" name="baby[{{ $key }}][dob]"
                                        value="{{ $value['dob'] }}"
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

            <div class="flex justify-center">
                <button type="submit"
                    class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p5-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                    Commander
                </button>
            </div>

        </form>
    </div>


    @if (!Auth::check())
        <div id="alert-additional-content-2"
            class="z-50 fixed bottom-0 right-0 sm:w-1/2 w-1/3 p-4 mb-4 mx-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">🔒 Connexion Requise 🔒</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                Pour accéder à cette fonctionnalité, veuillez vous connecter à votre compte. La connexion est nécessaire
                afin de garantir la sécurité de vos données et de vous offrir une expérience personnalisée.
                Si vous n'avez pas encore de compte, veuillez vous inscrire pour profiter pleinement de toutes les
                fonctionnalités offertes.
                Merci de votre compréhension et de votre collaboration. 🌐
            </div>
            <div class="flex justify-end">
                <button type="button"
                    class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-red-600 dark:border-red-600 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800"
                    data-dismiss-target="#alert-additional-content-2" aria-label="Close">
                    Dismiss
                </button>
            </div>
        </div>
    @endif
</x-app-layout>
