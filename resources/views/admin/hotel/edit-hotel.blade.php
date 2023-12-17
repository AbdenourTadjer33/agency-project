<x-admin-layout>
    <div class="bg-slate-900 py-2 px-4 text-center">
        <h1 class="text-white text-2xl font-medium">Modifier {{ $hotel->name }}</h1>
    </div>

    <div class="mx-auto my-5 px-16 py-4 w-1/2 bg-gray-400 rounded-md   bg-opacity-50 border border-gray-100">
        <form action="{{ route('admin.hotel.update', ['id' => $hotel->id]) }}" method="post">
            @csrf
            {{-- name --}}
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                    nom de l'hôtel
                </label>
                <input type="text" id="name" name="name" value="{{ $hotel->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="nom de l'hôtel" required>
                @error('name')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- description --}}

            <div class="mb-5">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Description
                </label>
                <textarea id="message" rows="4" name="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Description de l'hôtel...">{{ $hotel->description }}</textarea>
            </div>

            {{-- country --}}
            <div class="mb-5" x-init="">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">
                    pays de l'hôtel
                </label>
                <select id="countries" name="country"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach (Storage::json('public/data/country_info.json') as $country)
                        <option {{ $country['name'] == $hotel->country ? 'selected' : '' }}
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
            <div class="mb-5">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">
                    ville de l'hôtel
                </label>
                <input type="text" id="city" name='city' value="{{ $hotel->city }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required placeholder="Alger">
                @error('city')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- address --}}
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">
                    adresse de l'hôtel
                </label>
                <input type="text" id="address" name='address' value="{{ $hotel->address }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                @error('address')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{--  coordonnes  --}}
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    coordonnées de l'hôtel
                </label>
                <div class="mb-2">
                    <div class="pe-2">
                        <label for="phone-input" class="block text-sm font-medium text-gray-900">
                            N° tél
                        </label>
                    </div>

                    <div class="w-full">
                        <div class="flex items-center">
                            <select name="phone_code"
                                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 ">
                                @foreach (Storage::json('public/data/country_info.json') as $country)
                                    <option value="{{ $country['dial_code'] }}">
                                        {{ $country['flag'] . ' ' . $country['dial_code'] }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="relative w-full">
                                <input type="text" id="phone-input" name='coordinates[phone]'
                                    value="{{ json_decode($hotel->coordinates)->phone }}"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>
                    </div>

                    @error('coordinates.phone')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 pe-2">email</label>
                    <input type="email" id="email" name='coordinates[email]'
                        value="{{ json_decode($hotel->coordinates)->email }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="john.doe@company.com" required>

                    @error('coordinates.email')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- number of rooms --}}
            <div class="mb-5">
                <label for="nb_rooms" class="block mb-2 text-sm font-medium text-gray-900">
                    nombre de chambres
                </label>
                <input type="number" id="nb_rooms" name='nb_rooms' value="{{ $hotel->number_rooms }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('nb_rooms')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- rating --}}
            <div class="mb-5">
                <label for="rating" class="block mb-2 text-sm font-medium text-gray-900">
                    classification de l'hôtel
                </label>
                <input type="number" id="rating" name='rating' value="{{ $hotel->classification }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('rating')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- services --}}
            @php
                $services = json_decode($hotel->services, true);
            @endphp
            <div class="mb-5" x-data="{ tags: {{ Illuminate\Support\Js::from($services) }} }">
                <label for="services" class="block mb-2 text-sm font-medium text-gray-900">
                    service offert par l'hôtel
                </label>
                <div class="flex flex-wrap mt-1 select-none" id="tagButtons">
                    @foreach (Storage::json('public/data/hotel_services.json') as $tag)
                        @if (in_array($tag, $services))
                            <span wire:key='{{ Str::random(40) }}' x-data="{ selected: true }"
                                x-on:click="selected = !selected; selected ? tags.push(`{{ $tag }}`) : tags.splice(tags.indexOf(`{{ $tag }}`), 1); $refs.services.value = tags.join(',')"
                                x-bind:class="selected ?
                                    'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300' :
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300'"
                                class="cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $tag }}
                            </span>
                        @else
                            <span wire:key='{{ Str::random(40) }}' x-data="{ selected: false }"
                                x-on:click="selected = !selected; selected ? tags.push(`{{ $tag }}`) : tags.splice(tags.indexOf(`{{ $tag }}`), 1); $refs.services.value = tags.join(',')"
                                x-bind:class="selected ?
                                    'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300' :
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300'"
                                class="cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $tag }}
                            </span>
                        @endif
                    @endforeach
                </div>

                <input id="services" type="hidden" name='services' x-ref="services" value="{{ implode(',', $services) }}"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">


                @error('services')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Créer l'hôtel
            </button>

            <button type="reset"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Reset
            </button>
        </form>
    </div>
</x-admin-layout>
