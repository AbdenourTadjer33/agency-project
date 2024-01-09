<x-app-layout>
    <div class="my-10 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- First name -->
                <div>
                    <x-input-label for="fname" :value="__('Prénom')" />
                    <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div>

                <!-- Last name -->
                <div class="mt-4">
                    <x-input-label for="lname" :value="__('Nom')" />
                    <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname"
                        :value="old('lname')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                </div>

                {{-- Sex --}}
                <div class="mt-4">
                    <x-input-label for="sex" :value="__('sexe')" />
                    <select
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        name="sex" id="sex">
                        <option>sexe</option>
                        <option {{ old('sex') === 'female' ? 'selected' : '' }} value="female">femelle</option>
                        <option {{ old('sex') === 'male' ? 'selected' : '' }} value="male">mâle</option>
                    </select>
                    <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label :value="__('Date de naissance')" />
                    <div class="relative ">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom" type="text"
                            name="dob" value="{{ old('dob') }}"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="sélectionner une date">
                    </div>
                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                </div>

                {{-- Phone --}}
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Numéro de télephone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                        :value="old('phone')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-2 mt-4">
                    <a class="underline text-sm text-indigo-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit"
                        class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Créer un compte
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
