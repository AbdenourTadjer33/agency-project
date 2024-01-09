<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Mettez à jour les informations de profil.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="fname" :value="__('Prénom')" />
            <x-text-input id="fname" name="fname" type="text" class="mt-1 block w-full" :value="old('fname', $user->first_name)"
                required autofocus autocomplete="fname" />
            <x-input-error class="mt-2" :messages="$errors->get('fname')" />
        </div>

        <div>
            <x-input-label for="lname" :value="__('Nom')" />
            <x-text-input id="lname" name="lname" type="text" class="mt-1 block w-full" :value="old('lname', $user->last_name)"
                required autofocus autocomplete="lname" />
            <x-input-error class="mt-2" :messages="$errors->get('lname')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('N° tél')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)"
                required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="sex" :value="__('sexe')" />
            <select
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1"
                name="sex" id="sex">
                <option {{ old('sex', $user->sex) === 'female' ? 'selected' : '' }} value="female">Femme</option>
                <option {{ old('sex', $user->sex) === 'male' ? 'selected' : '' }} value="male">Homme</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('lname')" />
        </div>

        <div>
            <x-input-label for="lname" :value="__('Date de naissance')" />
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom" type="text"
                    name="dob" value="{{ old('dob', $user->dob) }}"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="sélectionner une date">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('lname')" />
        </div>

        <div>
            <x-input-label for="passport_id" :value="__('N° passport')" />
            <x-text-input id="passport_id" name="passport_id" type="text" class="mt-1 block w-full"
                :value="old('passport_id', $user->passport_id)" required autofocus autocomplete="passport_id" />
            <x-input-error class="mt-2" :messages="$errors->get('passport_id')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition ease-in-out duration-150 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modifier</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Vos information sont mis à jour.') }}</p>
            @endif
        </div>
    </form>
</section>
