<x-admin-layout>
    <x-slot:title>Créer un hotel</x-slot:title>
    <x-slot:script>{{ asset('storage/js/create-hotel.js') }}</x-slot:script>
    <div class="bg-gradient-to-tr from-purple-100 via-slate-200 to-stone-100 rounded shadow-2xl p-10">
        <form action="{{ route('admin.hotel.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                {{-- name --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                        Nom de l'hôtel (*)
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('name')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- number of rooms --}}
                <div>
                    <label for="nb_rooms" class="block mb-2 text-sm font-medium text-gray-900">
                        Nombre de chambres (*)
                    </label>
                    <input type="number" id="nb_rooms" name='nb_rooms' value="{{ old('nb_rooms') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('nb_rooms')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- classification --}}
                <div x-data="{ rate: {{ old('classification') ? old('classification') : 0 }} }">
                    <label class="block mb-3 text-sm font-medium text-gray-900">
                        Classification de l'hôtel (*)
                    </label>
                    <div class="mb-5 flex items-center justify-center">
                        <template x-for="i in 5">
                            <svg x-data="" x-bind:x-data="i"
                                x-on:click="rate= i; $refs.rating.value = i"
                                x-bind:class="{ 'text-yellow-300': rate >= i, 'text-gray-300 dark:text-gray-500': rate < i }"
                                class="hover:text-yellow-300 hover:transition-all duration-100 w-4 h-4 ms-1 cursor-pointer"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </template>
                    </div>
                    <input type="hidden" id="rating" name='classification' value="{{ old('classification') }}"
                        x-ref="rating"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('classification')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="sm:col-span-3">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description (*)
                    </label>
                    <textarea id="message" rows="4" name="description"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Description de l'hôtel...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- country --}}
                <div>
                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900">
                        Pays de l'hôtel (*)
                    </label>
                    <select id="country" name="country"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach (Storage::json('public/data/country_info.json') as $country)
                            <option {{ $country['name'] == old('country') ? 'selected' : '' }}
                                value="{{ $country['name'] }}">
                                {{ $country['flag'] . ' ' . $country['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('country')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- city --}}
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900">
                        Ville de l'hôtel (*)
                    </label>
                    <input type="text" id="city" name='city' value="{{ old('city') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('city')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- address --}}
                <div>
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">
                        Adresse de l'hôtel (*)
                    </label>
                    <input type="text" id="address" name='address' value="{{ old('address') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('address')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- phone number --}}
                <div>
                    <label for="phone_input" class="mb-2 block text-sm font-medium text-gray-900">
                        N° tél (*)
                    </label>
                    <div class="flex">
                        <select name="coordinates[phone_code]"
                            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 ">
                            @foreach (Storage::json('public/data/country_info.json') as $country)
                                <option {{ $country['code'] === old('phone_code') ? 'selected' : '' }}
                                    value="{{ $country['dial_code'] }}">
                                    {{ $country['flag'] . ' ' . $country['dial_code'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" id="phone_input" name='coordinates[phone]'
                            value="{{ old('coordinates.phone') }}"
                            class="bg-gray-50 text-gray-900 text-sm rounded-e-lg border-s-0 border border-gray-300  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    @error('coordinates.phone')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                        Email (*)
                    </label>
                    <input type="email" id="email" name='coordinates[email]'
                        value="{{ old('coordinates.email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('coordinates.email')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- website --}}
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-900 mb-2">Site web</label>
                    <input type="text" id="website" name='coordinates[website]'
                        value="{{ old('coordinates.website') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('coordinates.website')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- facebook --}}
                <div>
                    <label for="facebook" class="block text-sm font-medium text-gray-900 mb-2">Facebook</label>
                    <input type="text" id="facebook" name='coordinates[facebook]'
                        value="{{ old('coordinates.facebook') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('coordinates.facebook')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- instagram --}}
                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-900 mb-2">instagram</label>
                    <input type="text" id="instagram" name='coordinates[instagram]'
                        value="{{ old('coordinates.instagram') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('coordinates.instagram')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- booking --}}
                <div>
                    <label for="booking" class="block text-sm font-medium text-gray-900 mb-2">Booking</label>
                    <input type="text" id="booking" name='coordinates[booking]'
                        value="{{ old('coordinates.booking') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('coordinates.booking')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                {{-- Price adult --}}
                <div>
                    <label for="price_adult" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix adulte (*)
                    </label>
                    <input type="text" id="price_adult" name='price_adult' value="{{ old('price_adult') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('price_adult')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price child --}}
                <div>
                    <label for="price_child" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix enfant (*)
                    </label>
                    <input type="text" id="price_child" name='price_child' value="{{ old('price_child') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('price_child')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price baby --}}
                <div>
                    <label for="price_baby" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix bébe (*)
                    </label>
                    <input type="text" id="price_baby" name='price_baby' value="{{ old('price_baby') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('price_baby')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f1 --}}
                <div>
                    <label for="price_f1" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix formule petit déjenuer (*)
                    </label>
                    <input type="text" id="price_f1" name='price_f1' value="{{ old('price_f1') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('price_f1')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f2 --}}
                <div>
                    <label for="price_f2" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix formule demi pension (*)
                    </label>
                    <input type="text" id="price_f2" name='price_f2' value="{{ old('price_f2') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('price_f2')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f3 --}}
                <div>
                    <label for="price_f3" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix formule pension complete (*)
                    </label>
                    <input type="text" id="price_f3" name='price_f3' value="{{ old('price_f3') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('price_f3')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            {{-- services --}}
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Service offert par l'hôtel (*)
                </label>
                <div class="flex flex-wrap mt-1 select-none" id="tagButtons">
                    @foreach (Storage::json('public/data/hotel_services.json') as $tag)
                        @if (old('services') && in_array($tag, old('services')))
                            <span x-data="{ selected: true, value: `{{ $tag }}` }"
                                x-on:click="selected = !selected; selected ? addInput(value) : removeInput(value)"
                                x-bind:class="selected ?
                                    'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300' :
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300'"
                                class="inline-flex items-center cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $tag }}
                            </span>
                        @else
                            <span x-data="{ selected: false, value: `{{ $tag }}` }"
                                x-on:click="selected = !selected; selected ? addInput(value) : removeInput(value)"
                                x-bind:class="selected ?
                                    'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300' :
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300'"
                                class="inline-flex items-center cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $tag }}
                            </span>
                        @endif
                    @endforeach
                </div>
                <div id="selected-services">
                    @if (old('services'))
                        @foreach (old('services') as $service)
                            <input type="hidden" name="services[]" value="{{ $service }}">
                        @endforeach
                    @endif
                </div>
                @error('services')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- assets --}}
            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="assets">
                    Upload image de l'hôtel (*)
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="assets[]" id="assets" multiple type="file">
                <div id="target" class="mb-4 flex justify-center items-center gap-1"></div>
                <x-input-error :messages="$errors->get('assets')" class="mt-2" />
                @if ($errors->get('assets.*'))
                    @foreach ($errors->get('assets.*') as $error)
                        <x-input-error :messages="$error" class="mt-2" />
                    @endforeach
                @endif
            </div>

            {{-- buttons --}}
            <div class="flex justify-center">
                <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Créer l'hôtel
                </button>

                <button type="reset"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Reset
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
