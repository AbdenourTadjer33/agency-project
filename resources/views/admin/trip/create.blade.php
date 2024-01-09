<x-admin-layout>
    <x-slot:title>Créer un voyage oragnisé</x-slot:title>
    <x-slot:script>{{ asset('storage/js/create-trip.js') }}</x-slot:script>

    <div class="mt-2 bg-gradient-to-tr from-purple-100 via-slate-200 to-stone-100 rounded shadow-2xl p-10">
        <form action="{{ route('admin.trip.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                {{-- title --}}
                <h1 class="sm:col-span-3 text-center text-3xl font-bold capitalize text-slate-900 mb-5">
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
                            <option {{ old('category') == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">{{ $category->name }}</option>
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
                        <option {{ old('formule_base') === 'LPD' ? 'selected' : '' }} value="LPD">petit déjeuner
                            (LPD)</option>
                        <option {{ old('formule_base') === 'LDP' ? 'selected' : '' }} value="LDP">demi pension (LDP)
                        </option>
                        <option {{ old('formule_base') === 'LPC' ? 'selected' : '' }} value="LPC">pension complète
                            (LPC)</option>
                    </select>

                    @error('formule_base')
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
                    @error('description')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- destination --}}
                <div>
                    <label for="destination" class="block mb-2 text-sm font-medium text-gray-900">
                        Pays destination (*)
                    </label>
                    <select id="destination" name="destination"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="null">Sélectionnez une destination</option>
                        @foreach (Storage::json('public/data/country_info.json') as $country)
                            <option {{ $country['name'] == old('destination') ? 'selected' : '' }}
                                value="{{ $country['name'] }}">
                                {{ $country['flag'] . ' ' . $country['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('destination')
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
                <div class="sm:col-span-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Les dates proposés pour ce voyage oragnisé (*)
                        <span id="add-date"
                            class="ms-4 select-none cursor-pointer bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                            Ajouter une date
                        </span>
                    </label>

                    <div id="dates-container" data-len="1" class="mt-4 flex flex-col">
                        <div date-rangepicker class="flex items-center mb-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="dates[1][departure]" type="text" datepicker
                                    value="{{ old('dates.1.departure') }}"
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
                                <input name="dates[1][return]" type="text" datepicker
                                    value="{{ old('dates.1.return') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sélectionnez la date de fin">
                            </div>
                        </div>
                    </div>
                    @php
                        $errorDates = $errors->get('dates.*');
                        if ($errorDates && $errorDates != []) {
                            $errorDaparture = $errorDates['dates.1.departure'][0];
                            $errorReturn = $errorDates['dates.1.return'][0];
                        }
                    @endphp
                    @error('dates.*')
                        <div class="flex items-center gap-10">
                            <div class="text-red-800 error">{{ $errorDaparture }}</div>
                            <div class="text-red-800 error">{{ $errorReturn }}</div>
                        </div>
                    @enderror
                </div>
            </div>

            {{-- prices --}}
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
            </div>

            {{-- assets --}}
            <div class="sm:col-span-3 mb-2" id="trip-assets">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="assets">
                    Upload des images de ce voyages organisé (*)
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="assets[]" id="assets" multiple type="file">

                <div id="target" class="hidden relative overflow-x-auto shadow-md sm:rounded-lg my-4">
                    <table id="my-table"
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <img src="{{ asset('storage/' . $asset) }}"
                                        class="w-16 md:w-32 max-w-full max-h-full">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" name="description" placeholder="Description de l'image"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
                <x-input-error :messages="$errors->get('assets')" class="mt-2" />
                @if ($errors->get('assets.*'))
                    @foreach ($errors->get('assets.*') as $error)
                        <x-input-error :messages="$error" class="mt-2" />
                    @endforeach
                @endif
            </div>

            {{-- title --}}
            <h1 class="sm:col-span-3 text-center text-3xl font-bold capitalize text-slate-800 mb-5">
                Information sur l'héberegement
            </h1>

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- checkbox hotel --}}
                <div class="flex items-center sm:col-span-2 mb-4">
                    <input id="on_my_hotels" name="on_my_hotels" type="checkbox" value="1"
                        {{ request()->get('on_my_hotels') == '1' ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="on_my_hotels" class="ms-2 text-base font-medium text-gray-900 dark:text-gray-300">
                        hébergement dans l'un des hôtels existant.
                    </label>
                </div>

                {{-- hotel-id --}}
                <div class="sm:col-span-2 {{ request()->get('on_my_hotels') == '1' ? '' : 'hidden' }}"
                    id="hotel-id">
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Choississez un hôtel (*)
                    </label>
                    <select id="hotel-id" name="hotel_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Sélectionnez un hôtel</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->name . ' - ' . ($hotel->slug ? 'conventionné' : 'non conventionné') }}
                            </option>
                        @endforeach
                    </select>
                    @error('hotel_id')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div id="hotel-data" class="{{ request()->get('on_my_hotels') == '1' ? 'hidden' : '' }}">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    {{-- hotel name --}}
                    <div>
                        <label for="hotel[name]" class="block mb-2 text-sm font-medium text-gray-900">
                            Nom de l'hôtel (*)
                        </label>
                        <input type="text" id="hotel[name]" name="hotel[name]" value="{{ old('hotel[name]') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('hotel.name')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- classification --}}
                    <div x-data="{ rate: {{ old('hotel.classification') ? old('hotel.classification') : 0 }} }">
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
                        <input type="hidden" id="rating" name='hotel[classification]'
                            value="{{ old('classification') }}" x-ref="rating"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('hotel.classification')
                            <div class="text-red-800 error">{{ $message }}</div>
                        @enderror
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


    <script>
        const assetsInput = document.querySelector("#assets");
        const containerImgs = document.querySelector("div#target");
        const bodyTable = containerImgs.querySelector('tbody')

        const MAXFILE = 8;
        let isAlert = false;

        assetsInput.onchange = (event) => {
            const assets = assetsInput.files;
            if (assets.length > MAXFILE) {
                assetsInput.value = null;
                isAlert = true;
                alert("maximum file upload is " + MAXFILE);
            }
            bodyTable.innerHTML = "";

            let index = 0;
            while (!isAlert && index < assets.length) {
                containerImgs.classList.remove('hidden');
                const row = createRow(assets[index]);
                bodyTable.appendChild(row);

                index++; // increment to get the next file.
            }
            isAlert = false;
        };

        function createFileList(array) {
            const dataTransfer = new DataTransfer();

            array.forEach((file) => {
                dataTransfer.items.add(file);
            });

            return dataTransfer.files;
        }

        const createRow = (file) => {
            const imgPath = URL.createObjectURL(file);
            const imgName = file.name

            const row = document.createElement('tr');
            row.classList =
                'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
            row.setAttribute('data-file', file.name)

            // image column
            const colImg = document.createElement('td');
            colImg.classList = 'p-4';
            // img
            const img = document.createElement('img');
            img.classList = 'w-16 md:w-32 max-w-full max-h-full';
            img.src = imgPath;
            // append the imgEl to colImg
            colImg.appendChild(img);

            // legend column
            const colLegend = document.createElement('td');
            colLegend.classList = 'px-6 py-4 font-semibold text-gray-900 dark:text-white';
            // legend input
            const inputLegend = document.createElement('input');
            inputLegend.classList =
                'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
            inputLegend.setAttribute('placeholder', 'Description de l\'image');
            let nameAttrValue = imgName.replace(/[^a-zA-Z0-9]/g, '');
            inputLegend.setAttribute('name', nameAttrValue);
            // append the legend input to colLegend
            colLegend.appendChild(inputLegend);

            // actions column
            const colActions = document.createElement('td');
            colActions.classList = 'px-6 py-4';
            // deleteBtn
            const deleteAction = document.createElement('button');
            deleteAction.classList = 'font-medium text-red-600 dark:text-red-500 hover:underline remove-img';
            deleteAction.setAttribute('type', 'button');
            deleteAction.innerText = 'retirer';
            // append the delete btn to colActions
            colActions.appendChild(deleteAction);

            row.append(colImg, colLegend, colActions);

            return row;
        }

        document.onmousedown = event => {
            // drag & drop to order images
            const target = event.target.closest('div#target');
            if (target) {
                (function() {
                    
                    // Get the table and its rows
                    var table = document.getElementById('my-table');
                    var rows = table.rows;
                    // Initialize the drag source element to null
                    var dragSrcEl = null;

                    // Loop through each row (skipping the first row which contains the table headers)
                    for (var i = 1; i < rows.length; i++) {
                        var row = rows[i];
                        // Make each row draggable
                        row.draggable = true;

                        // Add an event listener for when the drag starts
                        row.addEventListener('dragstart', function(e) {
                            // Set the drag source element to the current row
                            dragSrcEl = this;
                            // Set the drag effect to "move"
                            e.dataTransfer.effectAllowed = 'move';
                            // Set the drag data to the outer HTML of the current row
                            e.dataTransfer.setData('text/html', this.outerHTML);
                            // Add a class to the current row to indicate it is being dragged
                            this.classList.add('bg-gray-100');
                        });

                        // Add an event listener for when the drag ends
                        row.addEventListener('dragend', function(e) {
                            // Remove the class indicating the row is being dragged
                            this.classList.remove('bg-gray-100');
                            // Remove the border classes from all table rows
                            table.querySelectorAll('.border-t-2', '.border-blue-300').forEach(function(el) {
                                el.classList.remove('border-t-2', 'border-blue-300');
                            });
                        });

                        // Add an event listener for when the dragged row is over another row
                        row.addEventListener('dragover', function(e) {
                            // Prevent the default dragover behavior
                            e.preventDefault();
                            // Add border classes to the current row to indicate it is a drop target
                            this.classList.add('border-t-2', 'border-blue-300');
                        });

                        // Add an event listener for when the dragged row enters another row
                        row.addEventListener('dragenter', function(e) {
                            // Prevent the default dragenter behavior
                            e.preventDefault();
                            // Add border classes to the current row to indicate it is a drop target
                            this.classList.add('border-t-2', 'border-blue-300');
                        });

                        // Add an event listener for when the dragged row leaves another row
                        row.addEventListener('dragleave', function(e) {
                            // Remove the border classes from the current row
                            this.classList.remove('border-t-2', 'border-blue-300');
                        });

                        // Add an event listener for when the dragged row is dropped onto another row
                        row.addEventListener('drop', function(e) {
                            // Prevent the default drop behavior
                            e.preventDefault();
                            // If the drag source element is not the current row
                            if (dragSrcEl != this) {
                                // Get the index of the drag source element
                                var sourceIndex = dragSrcEl.rowIndex;
                                // Get the index of the target row
                                var targetIndex = this.rowIndex;
                                // If the source index is less than the target index
                                if (sourceIndex < targetIndex) {
                                    // Insert the drag source element after the target row
                                    table.tBodies[0].insertBefore(dragSrcEl, this.nextSibling);
                                } else {
                                    // Insert the drag source element before the target row
                                    table.tBodies[0].insertBefore(dragSrcEl, this);
                                }
                            }
                            // Remove the border classes from all table rows
                            table.querySelectorAll('.border-t-2', '.border-blue-300').forEach(function(el) {
                                el.classList.remove('border-t-2', 'border-blue-300');
                            });
                        });
                    }
                })();
            }

            // remove an img from the fileList.
            const removeEl = event.target.closest(".remove-img");
            if (removeEl) {
                const row = removeEl.parentNode.parentNode;
                const fileName = row.getAttribute("data-file");
                const files = assetsInput.files;
                const filesArray = Array.from(files);
                const index = filesArray.indexOf(
                    filesArray.find((file) => file.name == fileName)
                );

                if (index > -1) {
                    filesArray.splice(index, 1);
                    const newFileList = createFileList(filesArray);
                    assetsInput.files = newFileList;
                    row.remove();
                }
            }
        }
    </script>

</x-admin-layout>
