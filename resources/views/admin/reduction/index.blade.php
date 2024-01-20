<x-admin-layout>

    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('status') }}</span>
        </div> </a>
    @endif

    @if (!empty($errors->toArray()))
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div>
                <span class="font-medium">Vous devez corriger les erreurs ci-dessous:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->toArray() as $errorKey => $errorValue)
                        @foreach ($errors->toArray()[$errorKey] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between mt-2">
        <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Créer un code promo
        </button>

        <div id="create-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Créer un code promo
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="create-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST" action="{{ route('admin.reductions.store') }}" class="p-4 md:p-5">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="code"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    code promo
                                </label>
                                <div class="relative">
                                    <input type="text" id="code" readonly name="code"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                                    <span id="btn-generate-code"
                                        class="cursor-pointer absolute top-1/2 right-0 -translate-y-1/2 bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                        Génerer un code
                                    </span>
                                </div>
                            </div>
                            <div class="col-span-2 flex items-center gap-4">
                                <div class="w-1/2">
                                    <label for="promoreduction"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Réduction %
                                    </label>
                                    <input id="promoreduction" name="reduction"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="w-1/2">
                                    <label for="promotrip"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Voyage Organisé
                                    </label>
                                    <select name="trip" id="promotrip"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @foreach ($trips as $trip)
                                            <option value="{{ $trip->id }}">
                                                {{ $trip->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-4">
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Créer
                            </button>

                            <button data-modal-hide="create-modal" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">ID</th>
                    <th scope="col" class="px-2 py-3">Voyage Organise</th>
                    <th scope="col" class="px-2 py-3">code</th>
                    <th scope="col" class="px-2 py-3">Reduction</th>
                    <th scope="col" class="px-2 py-3">Nombre d'utilisation</th>
                    <th scope="col" class="px-2 py-3">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promoCodes as $record)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $record->id }}
                        </th>
                        <th class="px-2 py-4">
                            {{ $record->trips->name }}
                        </th>
                        <th scope="row" class="px-2 py-4 ">
                            {{ $record->code }}
                        </th>
                        <th class="px-2 py-4">
                            {{ $record->reduction }}%
                        </th>
                        <th class="px-2 py-4">
                            {{ $record->count }}
                        </th>
                        <th class="px-2 py-4">
                            <button type="button" data-modal-target="edit-modal-{{ $record->id }}"
                                data-modal-toggle="edit-modal-{{ $record->id }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Editer
                            </button>
                            <div id="edit-modal-{{ $record->id }}" tabindex="-1" aria-hidden="true"
                                data-modal-backdrop="static"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Editer code promo {{ $record->id }}
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="edit-modal-{{ $record->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <form method="POST"
                                            action="{{ route('admin.reductions.update', ['id' => $record->id]) }}"
                                            class="p-4 md:p-5">
                                            @csrf
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="promocode"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Code promo
                                                    </label>
                                                    <div class="relative">
                                                        <input type="text" id="promocode" readonly
                                                            value="{{ $record->code }}" name="code"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                                                        <span
                                                            class="btn-regenerate-code cursor-pointer absolute top-1/2 right-0 -translate-y-1/2 bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                                            Génerer un code
                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="col-span-2 flex items-center gap-4">
                                                    <div class="w-1/2">
                                                        <label for="promoreduction"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                            Réduction %
                                                        </label>
                                                        <input id="promoreduction" name="reduction"
                                                            value="{{ $record->reduction }}"
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                    </div>
                                                    <div class="w-1/2">
                                                        <label for="promotrip"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                            Voyage Organisé
                                                        </label>
                                                        <select name="trip" id="promotrip"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                            @foreach ($trips as $trip)
                                                                <option
                                                                    {{ $trip->id === $record->trips->id ? 'selected' : '' }}
                                                                    value="{{ $trip->id }}">{{ $trip->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center gap-4">
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Modifier
                                                </button>

                                                <button data-modal-hide="edit-modal-{{ $record->id }}"
                                                    type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Annuler
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <button type="button" data-modal-target="delete-modal-{{ $record->id }}"
                                data-modal-toggle="delete-modal-{{ $record->id }}"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                Supprimer
                            </button>
                            <div id="delete-modal-{{ $record->id }}" tabindex="-1" data-modal-backdrop="static"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="delete-modal-{{ $record->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                Vous étes sur de vouloir supprimé le code promo {{ $record->id }} ?
                                            </h3>
                                            <div class="flex items-center gap-4 justify-center">
                                                <form
                                                    action="{{ route('admin.reductions.destroy', ['id' => $record->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                        Oui, Je suis Sur
                                                    </button>
                                                </form>
                                                <button data-modal-hide="delete-modal-{{ $record->id }}"
                                                    type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Non, Annuler
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.onload = () => {
            const btnGenerate = document.getElementById('btn-generate-code');
            const codeInputEl = document.getElementById('code');
            btnGenerate.onclick = async (e) => {
                try {
                    const response = await axios.post('{{ route('random.promoCode') }}');
                    if (response.status == 200) {
                        codeInputEl.value = response.data;
                    }
                } catch (error) {
                    console.error(error);
                }
            }


            const btns = document.querySelectorAll('.btn-regenerate-code');
            btns.forEach(btn => {
                btn.onclick = async (e) => {
                    try {
                        const inputEl = btn.parentNode.querySelector('input');
                        const res = await axios.post('{{ route('random.promoCode') }}');
                        if (res.status == 200) {
                            inputEl.value = res.data;
                        }
                    } catch (error) {
                        console.error(error);
                    }
                }
            })


        }
    </script>

</x-admin-layout>
