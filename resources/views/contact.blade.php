<x-app-layout>
    @php
        $agence = request()->agence;
        $agencyCoordinates = $agence['agency_coordinates'];
    @endphp
    <div class="sm:mx-8 mx-4 py-5">
        <h1
            class="text-3xl pb-5 text-center font-bold bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent sm:mt-2">
            A propos de nous
        </h1>
        <section class="flex flex-col sm:flex-row px-4 sm:px-8">
            <div class="w-full pt-2">
                <p class="text-center text-base leading-relaxed text-gray-900">
                    Depuis 1975, <b>Best tour travel agency</b> s’efforce d’offrir à nos clients le meilleur en matière
                    d’estime
                    et de plans de voyage de qualité. Nous sommes passionnés par le mouvement et le partage des
                    merveilles du monde du côté des voyages de détente, et donnons aux explorateurs d'entreprise un
                    bonjour pour contacter les administrations pour répondre à leurs besoins en matière de voyages
                    d'affaires.
                    <br>
                    Nous sommes une organisation de voyages revendiquée par les travailleurs et sécurisée par nos
                    qualités, notre fiabilité et notre engagement au bénéfice du client.
                    <br>
                    Notre organisation primée se positionne de manière fiable parmi les autres bureaux du pays (Travel
                    Weekly, Business Travel Weekly) et est la meilleure personne du célèbre Signature Travel Network,
                    une association globale nous permettant d'offrir à nos clients des avantages inégalés.
                </p>
            </div>
        </section>

        <div class="mt-5 flex flex-col sm:flex-row sm:justify-between" x-data="{}">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3196.4792696770874!2d2.958786283653192!3d36.759068400730285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128fb03bbe93354d%3A0x49802caf96073a6b!2sCentre%20commercial%20et%20d&#39;affaire%20AlQods!5e0!3m2!1sfr!2sdz!4v1704377457270!5m2!1sfr!2sdz"
                style="border:0;" allowfullscreen="" loading="lazy" class="h-80 sm:w-[60%] w-full mb-5 sm:mb-0"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            <div class="sm:w-[30%] w-full" id="accordion" data-accordion="collapse">
                @foreach ($agencyCoordinates as $agency)
                    <h2 id="accordion-collapse-heading-{{ $agency['id'] }}">
                        <button type="button"
                            class="flex items-center justify-center w-full p-2 font-medium rtl:text-right text-gray-500  border-b border-t  border-gray-200  focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                            data-accordion-target="#accordion-collapse-body-{{ $agency['id'] }}" aria-expanded="false"
                            aria-controls="accordion-collapse-body-{{ $agency['id'] }}">
                            <span>{{ $agency['name'] }}</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="false"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-{{ $agency['id'] }}"
                        class="{{ $agency['id'] > 1 ? 'hidden' : '' }}"
                        aria-labelledby="accordion-collapse-heading-{{ $agency['id'] }}">
                        <div class="p-2 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <address class="flex items-center py-2">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 21">
                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path
                                            d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                                    </g>
                                </svg>
                                {{ $agency['address'] . ', ' . $agency['city'] . ', ' . $agency['country'] }}
                            </address>
                            <span class="flex items-center py-2">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white me-2"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M228.44,89.34l-96-64a8,8,0,0,0-8.88,0l-96,64A8,8,0,0,0,24,96V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V96A8,8,0,0,0,228.44,89.34ZM96.72,152,40,192V111.53Zm16.37,8h29.82l56.63,40H56.46Zm46.19-8L216,111.53V192ZM128,41.61l81.91,54.61-67,47.78H113.11l-67-47.78Z">
                                    </path>
                                </svg>
                                {{ $agency['coordinates']['email'] }}
                            </span>
                            <span class="flex items-center py-2">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white me-2"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 256 256">
                                    <path
                                        d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                                    </path>
                                </svg>
                                {{ $agency['coordinates']['phone'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- contact form --}}
        <div class="mt-5">
            <form class="mx-auto max-w-2xl p-4 rounded-md bg-gradient-to-tr from-slate-100 via-gray-200 to-neutral-300"
                id="contact">
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

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Adresse email
                    </label>
                    <input type="email" id="email" name="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="richardhendricks@piedpiper.tech">
                    <div class="ps-2 text-red-800 error hidden"></div>

                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="mb-5">
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Prénom
                        </label>
                        <input type="text" id="fname" name="fname"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Richard">
                        <div class="ps-2 text-red-800 error hidden"></div>

                    </div>
                    <div class="mb-5">
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nom
                        </label>
                        <input type="text" id="lname" name="lname"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Hendricks">
                        <div class="ps-2 text-red-800 error hidden"></div>

                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="mb-5">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            N° télephone
                        </label>
                        <input type="tel" id="phone" name="phone" placeholder="+213"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                        <div class="ps-2 text-red-800 error hidden"></div>

                    </div>
                    <div class="mb-5">
                        <label for="objet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Objet
                        </label>
                        <input type="text" id="objet" name="objet"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                        <div class="ps-2 text-red-800 error hidden"></div>

                    </div>
                </div>

                <div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="px-4 py-2  rounded-t-lg dark:bg-gray-800">
                        <label for="message" class="sr-only">Votre message</label>
                        <textarea id="message" rows="4" name="message"
                            class="w-full px-0 text-sm text-gray-900 border-0 bg-gray-50 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                            placeholder="Write a comment..."></textarea>
                        <div class="ps-2 text-red-800 error hidden"></div>

                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-gradient-to-r from-cyan-500 to-blue-500  rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            <svg aria-hidden="true" role="status"
                                class=" w-4 h-4 me-3 text-white animate-spin hidden" viewBox="0 0 100 101"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
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
    </div>


    <script>
        window.onload = () => {
            const form = document.querySelector('form#contact');
            const btnSubmit = form.querySelector('button[type=submit]')

            const email = document.querySelector('input#email[name=email]');
            const fname = document.querySelector('input#fname[name=fname]');
            const lname = document.querySelector('input#lname[name=lname]');
            const phone = document.querySelector('input#phone[name=phone]');
            const objet = document.querySelector('input#objet[name=objet]');
            const message = document.querySelector('textarea#message[name=message]');

            const fields = [];

            form.onsubmit = async (event) => {
                event.preventDefault();
                const errors = {
                    email: email.parentNode.querySelector('.error'),
                    fname: fname.parentNode.querySelector('.error'),
                    lname: lname.parentNode.querySelector('.error'),
                    phone: phone.parentNode.querySelector('.error'),
                    objet: objet.parentNode.querySelector('.error'),
                    message: message.parentNode.querySelector('.error'),
                };

                try {
                    btnSubmit.querySelector('[role=status]').classList.remove('hidden');
                    const response = await axios.post("{{ route('contact.post') }}", {
                        email: email.value,
                        fname: fname.value,
                        lname: lname.value,
                        phone: phone.value,
                        objet: objet.value,
                        message: message.value,
                    });
                    const data = await response.data;
                    if (data.status === 'Success') {
                        const alertEl = document.querySelector('#alert');
                        alertEl.classList.remove('hidden', 'opacity-0');
                        alertEl.classList.add('flex', 'transition-opacity', 'duration-300', 'ease-in',
                            'opacity-1');
                        alertEl.querySelector('#content').innerText = data.message;
                        form.reset();
                    }
                } catch (error) {
                    if (error.response.status === 422) {
                        const data = await error.response.data;
                        for (const [key, value] of Object.entries(data.errors)) {
                            const errorBlock = errors[key];
                            errorBlock.classList.remove('hidden');
                            errorBlock.classList.add('inline');
                            errorBlock.innerText = value[0];
                        }
                    } else {
                        console.log(error);
                    }
                }
                btnSubmit.querySelector('[role=status]').classList.add('hidden');
            }
        }
    </script>


</x-app-layout>
