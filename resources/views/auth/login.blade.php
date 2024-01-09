<x-app-layout>
    <div class="my-20 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="space-y-4" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-0">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email ou n°
                        tél</label>
                    <input type="email" name="username" id="email" autocomplete="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de
                        passe</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div class="flex justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember_me" name="remember_me" type="checkbox"
                                class=" checked:bg-indigo-700 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                        </div>
                        <label for="remember_me" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Rester connecté
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-indigo-700 hover:underline dark:text-blue-500">
                        Mot de passe oublié ?
                    </a>
                </div>
                <div class="flex flex-col gap-2">
                    <button type="submit"
                        class="w-full text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Se connecté
                    </button>
                    <a href="{{ route('register') }}"
                        class="block w-full text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Créer un compte
                    </a>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
