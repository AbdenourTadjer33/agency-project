<x-admin-layout>
    <div class="bg-slate-900 py-2 px-4 text-center">
        <h1 class="text-white text-2xl font-medium">Créer un nouveau hotel</h1>
    </div>


    <div
        class="bg-gradient-to-tr from-purple-100 via-slate-200 to-stone-100 rounded shadow-2xl sm:mx-10 md:mx-20 lg:w-1/2 lg:mx-auto my-10 p-10">
        <form action="{{ route('admin.hotel.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- name --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                        Nom de l'hôtel
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nom de l'hôtel" required>
                    @error('name')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- number of rooms --}}
                <div>
                    <label for="nb_rooms" class="block mb-2 text-sm font-medium text-gray-900">
                        Nombre de chambres
                    </label>
                    <input type="number" id="nb_rooms" name='nb_rooms' value="{{ old('nb_rooms') }}" placeholder="30"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('nb_rooms')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description
                    </label>
                    <textarea id="message" rows="4" name="description"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Description de l'hôtel...">{{ old('description') }}</textarea>
                </div>

                {{-- country --}}
                <div>
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">
                        Pays de l'hôtel
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
                        Ville de l'hôtel
                    </label>
                    <input type="text" id="city" name='city' value="{{ old('city') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required placeholder="Alger">
                    @error('city')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- address --}}
                <div class="sm:col-span-2">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">
                        Adresse de l'hôtel
                    </label>
                    <input type="text" id="address" name='address' value="{{ old('address') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Mr John Smith. 132, My Street, Kingston, New York 12401" required>
                    @error('address')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- phone number --}}
                <div>
                    <label for="phone_input" class="mb-2 block text-sm font-medium text-gray-900">
                        N° tél
                    </label>
                    <div class="flex">
                        <select name="phone_code"
                            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 ">
                            @foreach (Storage::json('public/data/country_info.json') as $country)
                                <option {{ $country['code'] === old('phone_code') ? 'selected' : '' }}
                                    value="{{ $country['dial_code'] }}">
                                    {{ $country['flag'] . ' ' . $country['dial_code'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" id="phone_input" name='coordinates[phone]'
                            class="bg-gray-50 text-gray-900 text-sm rounded-e-lg border-s-0 border border-gray-300  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    @error('coordinates.phone')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
                    <input type="email" id="email" name='coordinates[email]'
                        value="{{ old('coordinates.email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="john.doe@company.com" required>

                    @error('coordinates.email')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- classification --}}
                <div class="sm:col-span-2 mb-2" x-data="{ rate: 0 }">
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
                    <input type="hidden" id="rating" name='rating' value="{{ old('nb_rooms') }}"
                        x-ref="rating"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('rating')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f1 --}}
                <div>
                    <label for="price_f1" class="block text-sm font-medium text-gray-900 mb-2">Prix de la nuit formule
                        petit-dej</label>
                    <input type="text" id="price_f1" name='price_f1' value="{{ old('price_f1') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="7 $" required>

                    @error('price')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f2 --}}
                <div>
                    <label for="price_f2" class="block text-sm font-medium text-gray-900 mb-2">Prix de la nuit formule
                        demi-pension</label>
                    <input type="text" id="price_f2" name='price_f2' value="{{ old('price_f2') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="12 $" required>

                    @error('price')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price f3 --}}
                <div class="sm:col-span-2">
                    <label for="price_f3" class="block text-sm font-medium text-gray-900 mb-2">Prix de la nuit
                        pension-complete</label>
                    <input type="text" id="price_f3" name='price_f3' value="{{ old('price_f3') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="15 $" required>

                    @error('price')
                        <div class="text-red-800 error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- services --}}
            @php
                $services = explode(',', old('services'));
            @endphp
            <div class="mb-5" x-data="{ tags: {{ Illuminate\Support\Js::from($services) }} }">
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

                <input id="services" type="hidden" name='services' x-ref="services"
                    value="{{ old('services') }}"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">


                @error('services')
                    <div class="text-red-800 error">{{ $message }}</div>
                @enderror
            </div>

            {{-- assets --}}
            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                    Upload image de l'hôtel
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
            </div>

            <div id="target" class="mb-4 flex justify-center items-center gap-1"></div>

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

<script>
    const assetsInput = document.querySelector('#file_input')
    const imagesTarget = document.querySelector('div#target')

    const MAXFILE = 6;
    let isAlert = false;

    assetsInput.onchange = (event) => {
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
<script src="{{ asset('storage/js/croppie.js') }}"></script>
