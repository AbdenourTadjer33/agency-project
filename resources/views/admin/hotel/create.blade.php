<x-admin-layout>
    <x-slot:title>Créer un hotel</x-slot:title>
    <x-slot:script>{{ asset('storage/js/create-hotel.js') }}</x-slot:script>
    <div class="bg-gradient-to-tr from-purple-100 via-slate-200 to-stone-100 rounded shadow-2xl p-10">
        <form action="{{ route('admin.hotel.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                {{-- title --}}
                <h1 class="sm:col-span-3 text-center text-3xl font-bold capitalize text-slate-900 mb-5">
                    Créer un nouveau hôtel
                </h1>
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
                        <tbody></tbody>
                    </table>
                </div>
                <x-input-error :messages="$errors->get('assets')" class="mt-2" />
                @if ($errors->get('assets.*'))
                    @foreach ($errors->get('assets.*') as $error)
                        <x-input-error :messages="$error" class="mt-2" />
                    @endforeach
                @endif
            </div>

            {{-- buttons --}}
            <div class="flex justify-center mt-4">
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
