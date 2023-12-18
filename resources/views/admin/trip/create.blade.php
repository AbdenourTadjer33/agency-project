<x-admin-layout>
    <div class="mt-2 bg-gradient-to-tr from-purple-100 via-slate-200 to-stone-100 rounded shadow-2xl p-10">
        <form action="{{ route('admin.trip.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                {{-- title --}}
                <h1 class="sm:col-span-3 text-center text-3xl font-bold capitalize text-slate-800 mb-5">
                    Information sur le voyage organisé
                </h1>

                {{-- name --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                        Nom de voyage organisé (*)
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('name')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- category of trip --}}
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">
                        Categorie (*)
                        <span data-modal-target="category-modal" data-modal-toggle="category-modal"
                            class="ms-4 cursor-pointer bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                            Ajouter une catégorie
                        </span>
                    </label>
                    <select id="category" name="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Sélectionnez la catégorie de voyage organisé</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- formula base --}}
                <div>
                    <label for="formule_base" class="block mb-2 text-sm font-medium text-gray-900">
                        Formule de base (*)
                    </label>
                    <select id="formule_base" name="formule_base"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Sélectionnez la formule de base</option>
                        <option value="petit-dej">petit déjeuner</option>
                        <option value="demi-pension">demi pension</option>
                        <option value="pension-complete">pension complète</option>
                    </select>

                    @error('category')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="sm:col-span-3">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description (*)
                    </label>
                    <textarea id="description" rows="4" name="description"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Description de voyage organisé">{{ old('description') }}</textarea>
                </div>

                {{-- programme --}}
                <div class="sm:col-span-3">
                    <label for="programme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Programme (*)
                    </label>
                    <textarea id="programme" rows="4" name="program"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Programme de voyage organisé...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- destination --}}
                <div>
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">
                        Pays destination (*)
                    </label>
                    <select id="countries" name="country"
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
                        Ville destination (*)
                    </label>
                    <input type="text" id="city" name='city' value="{{ old('city') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('city')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- dates --}}
                <div class="sm:col-span-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Les dates proposés pour ce voyage oragnisé (*)
                        <span id="add-date"
                            class="ms-4 select-none cursor-pointer bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                            Ajouter une date
                        </span>
                    </label>

                    <div id="dates-container" class="mt-4 flex flex-col"> {{-- dates container --}}
                        <div date-rangepicker class="flex items-center mb-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="start" type="text" datepicker
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sélectionnez la date de début">
                            </div>
                            <span class="mx-4 text-gray-500">au</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="end" type="text" datepicker
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sélectionnez la date de fin">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                {{-- Price adult --}}
                <div>
                    <label for="price_adult" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix adult
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
                        Prix enfant
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
                        Prix bébe
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
                        Prix formule petit déjuner
                    </label>
                    <input type="text" id="price_f1" name='price_f1' value="{{ old('price_f1') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        disabled>

                    @error('price_f1')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f2 --}}
                <div>
                    <label for="price_f2" class="block text-sm font-medium text-gray-900 mb-2">
                        Prix formule demi pension
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
                        Prix formule pension compléte
                    </label>
                    <input type="text" id="price_f3" name='price_f3' value="{{ old('price_f3') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    @error('price_f3')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- assets --}}
            <div class="sm:col-span-3 mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                    Upload des images de ce voyages organisé (*)
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="assets[]" id="file_input" multiple type="file">
                <x-input-error :messages="$errors->get('assets')" class="mt-2" />
                @if ($errors->get('assets.*'))
                    @foreach ($errors->get('assets.*') as $error)
                        <x-input-error :messages="$error" class="mt-2" />
                    @endforeach
                @endif
                <div id="target" class="flex justify-center items-center gap-1 mt-3"></div>
            </div>

            {{-- title --}}
            <h1 class="sm:col-span-3 text-center text-3xl font-bold capitalize text-slate-800 mb-5">
                Information sur l'héberegement
            </h1>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- checkbox hotel --}}
                <div class="flex items-center sm:col-span-2 mb-4">
                    <input id="on_my_hotels" name="on_my_hotels" type="checkbox" checked
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="on_my_hotels" class="ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                        hébergement dans l'un de mes hôtel associe.
                    </label>
                </div>

                {{-- hotel_id --}}
                <div class="sm:col-span-2" id="hotel-id">
                    <label for="hotel_id" class="block mb-2 text-sm font-medium text-gray-900">
                        nom d'hôtel (*)
                    </label>
                    <select id="hotel_id" name="hotel_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Sélectionnez un hôtel</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="hotel-data" class="hidden">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    {{-- hotel name --}}
                    <div>
                        <label for="hotel[name]" class="block mb-2 text-sm font-medium text-gray-900">
                            Nom de l'hôtel
                        </label>
                        <input type="text" id="hotel[name]" name="hotel[name]" value="{{ old('hotel[name]') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('name')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- classification --}}
                    <div x-data="{ rate: 0 }">
                        <label class="block mb-3 text-sm text-center font-medium text-gray-900">
                            Classification de l'hôtel
                        </label>

                        <div class="flex items-center justify-center">
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
                        <input type="hidden" id="hotel[classification]" name='hotel[classification]'
                            value="{{ old('hotel[classification]') }}" x-ref="rating"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    {{-- country --}}
                    <div>
                        <label for="hotel[country]" class="block mb-2 text-sm font-medium text-gray-900">
                            Pays de l'hôtel
                        </label>
                        <select id="hotel[country]" name="hotel[country]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach (Storage::json('public/data/country_info.json') as $country)
                                <option {{ $country['name'] == old('country') ? 'selected' : '' }}
                                    value="{{ $country['name'] }}">
                                    {{ $country['flag'] . ' ' . $country['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('hotel.country')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- city --}}
                    <div>
                        <label for="hotel[city]" class="block mb-2 text-sm font-medium text-gray-900">
                            Ville de l'hôtel
                        </label>
                        <input type="text" id="hotel[city]" name='hotel[city]' value="{{ old('hotel.city') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('city')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address --}}
                    <div>
                        <label for="hotel[address]" class="block mb-2 text-sm font-medium text-gray-900">
                            Adresse de l'hôtel
                        </label>
                        <input type="text" id="hotel[address]" name='hotel[address]'
                            value="{{ old('hotel.address') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('hotel.address')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- services --}}
                    @php
                        $services = explode(',', old('services'));
                    @endphp
                    <div class="mb-5 sm:col-span-3" x-data="{ tags: {{ Illuminate\Support\Js::from($services) }} }">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Service offert par l'hôtel
                        </label>
                        <div class="flex flex-wrap mt-1 select-none" id="tagButtons">
                            @foreach (Storage::json('public/data/hotel_services.json') as $tag)
                                @if (old('services'))
                                    @if (in_array($tag, $services))
                                        <span x-data="{ selected: true }"
                                            x-on:click="selected = !selected; selected ? tags.push(`{{ $tag }}`) : tags.splice(tags.indexOf(`{{ $tag }}`), 1); $refs.services.value = tags.join(',')"
                                            x-bind:class="selected ?
                                                'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300' :
                                                'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300'"
                                            class="cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $tag }}
                                        </span>
                                    @else
                                        <span x-data="{ selected: false }"
                                            x-on:click="selected = !selected; selected ? tags.push(`{{ $tag }}`) : tags.splice(tags.indexOf(`{{ $tag }}`), 1); $refs.services.value = tags.join(',')"
                                            x-bind:class="selected ?
                                                'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300' :
                                                'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300'"
                                            class="cursor-pointer text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $tag }}
                                        </span>
                                    @endif
                                @else
                                    <span x-data="{ selected: false }"
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

                        <input id="services" type="hidden" name='hotel[services]' x-ref="services"
                            value="{{ old('hotel.services') }}"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">


                        @error('hotel.services')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- assets --}}
                    <div class="sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="hotel[assets][]">
                            Upload image de l'hôtel
                        </label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            name="hotel[assets][]" id="hotel[assets][]" multiple type="file">
                        @if ($errors->get('assets.*'))
                            @foreach ($errors->get('hotel.assets.*') as $error)
                                <x-input-error :messages="$error" class="mt-2" />
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- submit & reset btns --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Créer le voyage
                </button>

                <button type="reset"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Reset
                </button>
            </div>
        </form>
    </div>

    {{-- modal to add new trip category --}}
    <div id="category-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ajouter une catégorie
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="category-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form id="new-category">
                        <label for="category-name" class="block mb-2 text-sm font-medium text-gray-900">
                            Nom de la nouvelle catégorie (*)
                        </label>
                        <div class="flex">
                            <input type="text" id="category-name" name="category-name"
                                class="rounded-l-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <button type="submit"
                                class="flex items-center rounded-r-lg text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <div role="status" class="pe-3 hidden">
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span>Ajouter</span>
                            </button>
                        </div>
                    </form>

                    <div class="categories">
                        @foreach ($categories as $category)
                            <span
                                class="bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300 text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  file script  --}}
    <script>
        const assetsInput = document.querySelector('#file_input')
        const imagesTarget = document.querySelector('div#target')

        const MAXFILE = 6;
        let isAlert = false;

        assetsInput.onchange = (event) => {
            event.stopPropagation();
            const assets = assetsInput.files;
            if (assets.length > MAXFILE) {
                assetsInput.value = null;
                isAlert = true;
                alert('maximum file upload is ' + MAXFILE);
            }
            imagesTarget.innerHTML = "";
            let index = 0;
            while (!isAlert && index < assets.length) {
                const path = URL.createObjectURL(assets[index]);
                // container Div
                const containerImgBg = document.createElement('div');

                containerImgBg.setAttribute('data-file', assets[index].name);

                containerImgBg.classList.add("relative", "img-editor", "w-28", "h-28", "bg-center", "bg-no-repeat",
                    "bg-cover", "transition", "duration-100");
                containerImgBg.style.backgroundImage = `url(${path})`;
                // removerSpan
                const remover = document.createElement('span');
                remover.classList.add('z-50', 'absolute', 'cursor-pointer', 'img-remove');
                remover.setAttribute('title', 'supprimer l\'image');
                remover.style.top = "3px";
                remover.style.right = "3px";
                remover.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-300  shadow-2xl" fill="currentColor"><path d="m12,0C5.383,0,0,5.383,0,12s5.383,12,12,12,12-5.383,12-12S18.617,0,12,0Zm3.707,14.293c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293,2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l2.293,2.293,2.293-2.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414l-2.293,2.293,2.293,2.293Z"/></svg>`

                containerImgBg.append(remover)

                const overlay = document.createElement('div');
                overlay.classList.add('overlay');
                const editIconSpan = document.createElement('span')
                editIconSpan.innerText = "✎";
                editIconSpan.classList.add('edit-icon')


                overlay.append(editIconSpan);
                containerImgBg.append(overlay);

                imagesTarget.append(containerImgBg)
                index++
            }
            isAlert = false;
        }


        document.onclick = (event) => {
            const target = event.target.closest('.img-remove')

            if (target) {
                const fileName = target.parentNode.getAttribute('data-file');
                const files = assetsInput.files;
                const filesArray = Array.from(files)
                const index = filesArray.indexOf(filesArray.find(file => file.name == fileName))

                if (index > -1) {
                    filesArray.splice(index, 1)
                    const newFileList = createFileList(filesArray);
                    assetsInput.files = newFileList;
                    target.parentNode.remove()
                }
            }
        }

        function createFileList(array) {
            const dataTransfer = new DataTransfer();

            array.forEach(file => {
                dataTransfer.items.add(file);
            });

            return dataTransfer.files;
        }
    </script>

    {{-- add date & delete them & add new category script --}}
    <script>
        const datesContainer = document.querySelector('#dates-container');
        const addBtn = document.querySelector('#add-date');

        window.onload = function() {
            // adding date inputs
            addBtn.onclick = (event) => {
                event.stopPropagation();
                // Create the main container div
                const dateRangePickerContainer = document.createElement('div');
                dateRangePickerContainer.setAttribute('date-rangepicker', '');
                dateRangePickerContainer.classList.add('flex', 'items-center', 'mb-1');

                // Create the first date input container
                const startDateContainer = createInputContainer('start', 'Sélectionnez la date de début');

                // Create the "to" span
                const toSpan = document.createElement('span');
                toSpan.classList.add('mx-4', 'text-gray-500');
                toSpan.textContent = 'au';

                // Create the second date input container
                const endDateContainer = createInputContainer('end', 'Sélectionnez la date de fin');

                // create the "delete" btn
                const deleteBtn = document.createElement('span');
                deleteBtn.classList =
                    'flex delete-btn disabled:bg-slate-200 disabled:border-red-400 disabled:cursor-not-allowed disabled:shadow-none cursor-pointer shadow-md ms-4 bg-red-100 text-red-800 font-medium px-2 py-2 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400';
                deleteBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-red-400" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                    </path>
                                    </svg>`;


                // Append elements to the main container
                dateRangePickerContainer.appendChild(startDateContainer);
                dateRangePickerContainer.appendChild(toSpan);
                dateRangePickerContainer.appendChild(endDateContainer);
                dateRangePickerContainer.appendChild(deleteBtn)

                datesContainer.appendChild(dateRangePickerContainer)

                const customEvent = new CustomEvent('new-daterangepicker', {
                    detail: {
                        element: dateRangePickerContainer
                    }
                });

                document.dispatchEvent(customEvent);
            }
            // delete date inputs
            document.onclick = (event) => {
                const deleteBtn = event.target.closest('.delete-btn')
                if (deleteBtn) {
                    deleteBtn.parentNode.remove()
                }
            }

            // adding new categories
            const formCategory = document.querySelector('form#new-category');
            const btnSubmit = formCategory.querySelector('button[type=submit]')
            onsubmit = async (event) => {
                event.preventDefault();
                const categoryName = document.querySelector('input[name=category-name]#category-name').value
                try {
                    btnSubmit.querySelector('[role=status]').classList.remove('hidden')
                    const response = await axios.post('{{ route('admin.store.category') }}', {
                        name: categoryName,
                    });
                    const dataCategories = response.data.categories;
                    const categoriesContainer = formCategory.parentNode.querySelector('.categories');
                    categoriesContainer.innerHTML = "";
                    dataCategories.forEach(item => {
                        categoriesContainer.innerHTML += `<span
                                    class="bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300 text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                    ${item.name}
                                </span>`
                    })

                    const categoryOptionContainer = document.querySelector('#category');
                    categoryOptionContainer.innerHTML = "";
                    dataCategories.forEach(item => {
                        categoryOptionContainer.innerHTML += `<option value="${item.id}">${item.name} </option>`;
                    });
                    btnSubmit.querySelector('[role=status]').classList.add('hidden')
                } catch (error) {
                    console.log(error);
                }
            }
        }

        // Function to create date input container
        function createInputContainer(name, placeholder) {
            const inputContainer = document.createElement('div');
            inputContainer.classList.add('relative');

            const iconContainer = document.createElement('div');
            iconContainer.classList.add('absolute', 'inset-y-0', 'start-0', 'flex', 'items-center', 'ps-3',
                'pointer-events-none');

            iconContainer.innerHTML = `<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>`;

            const dateInput = document.createElement('input');
            dateInput.setAttribute('name', name);
            dateInput.setAttribute('type', 'text');
            dateInput.setAttribute('datepicker', '');
            dateInput.classList.add(
                'bg-gray-50', 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-lg',
                'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'w-full', 'ps-10', 'p-2.5',
                'dark:bg-gray-700', 'dark:border-gray-600', 'dark:placeholder-gray-400',
                'dark:text-white', 'dark:focus:ring-blue-500', 'dark:focus:border-blue-500'
            );
            dateInput.setAttribute('placeholder', placeholder);

            // Append elements to the input container
            inputContainer.appendChild(iconContainer);
            inputContainer.appendChild(dateInput);

            const customEvent = new CustomEvent('new-datepicker', {
                detail: {
                    element: dateInput
                }
            });
            document.dispatchEvent(customEvent);
            return inputContainer;
        }
    </script>

    {{-- disable formula price of the base formula --}}
    <script>
        const selectFormula = document.querySelector('#formule_base');
        selectFormula.onchange = (event) => {
            event.stopPropagation();
            ['#price_f1', '#price_f2', '#price_f3'].forEach(id => {
                const field = document.querySelector(id)
                field.removeAttribute('disabled');
                field.classList.remove('disabled:bg-red-200', 'disabled:border-red-400', 'disabled:shadow-none',
                    'disabled:cursor-not-allowed')
            })
            if (selectFormula.value === 'petit-dej') {
                const priceF1 = document.querySelector('#price_f1');
                priceF1.setAttribute('disabled', '');
                priceF1.classList.add('disabled:bg-red-200', 'disabled:border-red-400', 'disabled:shadow-none',
                    'disabled:cursor-not-allowed');
            } else if (selectFormula.value === 'demi-pension') {
                const priceF2 = document.querySelector('#price_f2');
                priceF2.setAttribute('disabled', '');
                priceF2.classList.add('disabled:bg-red-200', 'disabled:border-red-400', 'disabled:shadow-none',
                    'disabled:cursor-not-allowed');
            } else if (selectFormula.value === 'pension-complete') {
                const priceF3 = document.querySelector('#price_f3');
                priceF3.setAttribute('disabled', '');
                priceF3.classList.add('disabled:bg-red-200', 'disabled:border-red-400', 'disabled:shadow-none',
                    'disabled:cursor-not-allowed');
            }

        }
    </script>

    {{-- add new hotel or select existing one --}}
    <script>
        const checkBox = document.querySelector('#on_my_hotels');
        const hotelId = document.querySelector('#hotel-id')
        const hotelData = document.querySelector('#hotel-data');

        checkBox.onchange = event => {
            checkBox.checked ? hotelData.classList.add('hidden') : hotelData.classList.remove('hidden');
            checkBox.checked ? hotelId.classList.remove('hidden') : hotelId.classList.add('hidden')
        }
    </script>





</x-admin-layout>
