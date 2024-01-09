<x-app-layout>
    <x-slot:title>Foire Au Questions - Best tour</x-slot:title>

    {{-- banner --}}
    <div class="relative">
        <div class="w-full h-64 bg-gradient-to-tl from-violet-200 via-indigo-100 to-violet-300 shadow">
            <img class="absolute bottom-5 sm:left-10 left-5 sm:w-40 w-28 h-auto"
                src="{{ asset('storage/images/default.png') }}">
            <div
                class="sm:text-6xl text-2xl sm:scale-125 font-semibold absolute sm:top-1/2 top-10 left-1/2 -translate-x-1/2 sm:-translate-y-1/2 bg-gradient-to-tl from-sky-600 via-cyan-600 to-sky-500 bg-clip-text text-transparent text-center">
                Foire aux question
            </div>
            <img class="absolute bottom-7 sm:right-10 right-5 sm:w-56 w-36 h-auto"
                src="{{ asset('storage/images/tickets.png') }}">
        </div>
    </div>


    <div class="py-10 mx-4 sm:mx-8">
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session('status') }}</span>
            </div>
        @endif

        <div class="flex gap-10 justify-center flex-wrap">
            @foreach ($faqs as $faq)
                @php
                    $createdAt = new \Carbon\Carbon(new DateTime($faq->created_at));
                    if ($faq->faqReponse) {
                        $replyAt = new \Carbon\Carbon(new DateTime($faq->faqReponse->created_at));
                    }
                @endphp
                <div
                    class="w-full max-w-sm h-min bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:bg-gray-50">
                    <div class="p-4">
                        {{-- user informations --}}
                        @if ($faq->user)
                            <div class="flex items-center justify-start">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 px-3 py-2 border-2 hover:ring-1 text-base leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <span
                                        class="font-medium text-gray-600 dark:text-gray-300 select-none cursor-default">
                                        {{ strtoupper(substr($faq->user->first_name, 0, 1) . substr($faq->user->last_name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="ms-2 text-sm text-slate-900 font-medium flex flex-col">
                                    <span
                                        class="capitalize">{{ $faq->user->first_name . ' ' . $faq->user->last_name }}</span>
                                    <span class="text-indigo-700"> {{ $createdAt->diffForHumans() }}</span>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center justify-start">
                                <svg class="w-16 h-16 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                </svg>
                                <div class="ms-2 text-sm text-slate-900 font-medium flex flex-col">
                                    <span class="capitalize">{{ $faq->name }}</span>
                                    <span class="text-indigo-700">{{ $createdAt->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- message --}}
                        <div class="mt-3">{{ $faq->message }}</div>
                        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                        @if ($faq->faqReponse)
                            {{-- Response --}}
                            <blockquote
                                class="p-2 border-s-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                                <p class="text-base italic font-medium leading-relaxed text-gray-900 dark:text-white">
                                    "{{ $faq->faqReponse->message }}"
                                </p>
                            </blockquote>
                            <div class="mt-2 italic text-sm text-center">
                                Répondu par <span class="not-italic font-medium">l'admin</span> <span
                                    class="text-indigo-700">{{ $replyAt->diffForHumans() }}</span>
                            </div>
                        @else
                            <div class="flex justify-center">
                                <img class=" w-40 h-auto" src="{{ asset('storage/images/accounts_transfers.png') }}">
                            </div>
                            <div class="text-center text-sm text-gray-400 font-medium">Pas de réponse encore</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="sm:mx-auto mx-4 mb-5">
        <form method="POST" action="{{ route('faq.store') }}"
            class="mx-auto max-w-2xl p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-lg transition duration-200 hover:shadow">
            @csrf
            <div id="alert"
                class="items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 hidden opacity-0 "
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div id="content" class="ms-3 text-sm font-medium"></div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            @if (!Auth::check())
                <div class="mb-5">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Nom Prénom
                    </label>
                    <input type="name" id="name" name="name"
                        class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <div class="ps-2 text-red-800 error hidden"></div>
                </div>
            @else
                <div class="mb-5">
                    <div class="flex items-center justify-start">
                        <div
                            class="inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 px-3 py-2 border-2 hover:ring-1 text-base leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <span class="font-medium text-gray-600 dark:text-gray-300 select-none cursor-default">
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="ms-2 text-sm text-slate-900 font-medium flex flex-col">
                            <span
                                class="capitalize">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="w-full border border-gray-200 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600">
                <div class="px-4 py-2 rounded-t-lg">
                    <label for="message" class="sr-only">Votre message</label>
                    <textarea id="message" rows="4" name="message"
                        class="w-full px-0 text-sm text-gray-900 border-0 bg-white dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="Votre question..."></textarea>
                    <div class="ps-2 text-red-800 error hidden"></div>

                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                    <button type="submit"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-gradient-to-r from-cyan-500 to-blue-500  rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:shadow hover:text-blue-50">
                        <svg aria-hidden="true" role="status" class=" w-4 h-4 me-3 text-white animate-spin hidden"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                        Soumettre
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>


{{-- <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:bg-gray-50">
                <div class="p-4">
                    <div class="flex items-center justify-start">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 px-3 py-2 border-2 hover:ring-1 text-base leading-4 font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <span class="font-medium text-gray-600 dark:text-gray-300 select-none cursor-default">
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="ms-2 text-sm text-slate-900 font-medium flex flex-col">
                            <span
                                class="capitalize">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                            <span class="text-indigo-700"> {{ $carbon->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam itaque nihil earum dignissimos
                        rem dolores dolorum facilis aperiam, error totam blanditiis assumenda atque, ipsa unde
                        laudantium voluptatem odit? Obcaecati, cupiditate!
                    </div>
                    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                    <blockquote class="p-2 border-s-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                        <p class="text-base italic font-medium leading-relaxed text-gray-900 dark:text-white">
                            "Flowbite is just awesome. It contains tons of predesigned components and pages starting
                            from login
                            screen to complex dashboard. Perfect choice for your next SaaS application."
                        </p>
                    </blockquote>
                    <div class="mt-2 italic text-sm text-center">
                        Réponse par <span class="not-italic font-medium">l'admin</span> <span
                            class="text-indigo-700">{{ $carbon->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:bg-gray-50">
                <div class="p-4">
                    <div class="flex items-center justify-start">
                        <svg class="w-16 h-16 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                        </svg>
                        <div class="ms-2 text-base text-slate-900 font-medium flex flex-col">
                            <span class="capitalize">Inconnue</span>
                            <span>{{ $carbon->diffForHumans() }}</span>
                        </div>
                    </div>

                </div>
            </div> --}}
