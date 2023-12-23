<x-admin-layout>
    @if (session('status'))
        <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif

    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-around py-4">
        <a href="#">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Ajouter un nouveau siége
            </button>
        </a>

        <a href="#">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Ajouter un nouveau admin
            </button>
        </a>

        <a href="#">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Ajouter un nouveau network
            </button>
        </a>
    </div>

    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        Network
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Lien
                    </th>

                    <th scope="col" class="px-2 py-3">
                        Opération
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach (json_decode($agency->networks, true) as $network => $link)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $network }}
                        </th>

                        <td class="px-2 py-2">
                            <a href="{{ $link }}" class="text-blue-500 underline">{{ $link }}</a>
                        </td>

                        <td class="px-2 py-2 flex gap-2">
                            <a href="#"
                                class="block focus:outline-none text-purple-400 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-2 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Modifier
                            </a>
                            <a href="#"
                                class="focus:outline-none text-red-400 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        Nom prénom
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Télephone
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Date de naissance
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($admins as $admin)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ucfirst($admin->last_name) }} {{ ucfirst($admin->first_name) }}
                        </th>

                        <td class="px-2 py-4">
                            {{ $admin->email }}
                        </td>

                        <td class="px-2 py-4">
                            {{ $admin->phone }}
                        </td>

                        <td class="px-2 py-4">
                            {{ $admin->dob }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        Siége
                    </th>
                    <th scope="col" class="px-2 py-3">
                        adresse
                    </th>
                    <th scope="col" class="px-2 py-3">
                        télephone
                    </th>
                    <th scope="col" class="px-2 py-3">
                        email
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($coordinates as $coordinate)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        {{-- name --}}
                        <th scope="row"
                            class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $coordinate->name }}
                        </th>

                        {{-- address --}}
                        <td class="px-2 py-4">
                            {{ $coordinate->address }}, {{ $coordinate->city }}, {{ $coordinate->country }}
                        </td>

                        {{-- tél --}}
                        <td class="px-2 py-4">
                            {{ json_decode($coordinate->coordinates)->phone }}
                        </td>

                        {{-- email --}}
                        <td class="px-2 py-4">
                            {{ json_decode($coordinate->coordinates)->email }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
