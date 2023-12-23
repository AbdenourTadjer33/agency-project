<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Best Tour Algérie' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased h-full" x-data="{ show_backToTop: false }"
    @scroll.window="show_backToTop = window.pageYOffset > 30">
    <div>
        @include('layouts.top-bar')
        @include('layouts.nav-bar')
        <main>
            {{ $slot }}
        </main>
        @isset($script)
            <script src="{{ $script }}"></script>
        @endisset
        <div :class="show_backToTop ? 'block' : 'hidden'">
            <div id="back_To_Top" x-ref="backTotop" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="fixed bottom-16 right-5 z-40 overflow-hidden">
                <button
                    class="rounded-lg shadow-2xl shadow-slate-300 hover:bg-opacity-100 hover:bg-gray-500 hover:text-white bg-gray-800 bg-opacity-25 text-white p-3 ">
                    <svg class="w-6 h-6 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </button>
            </div>
        </div>

        <script>
            document.onscroll = (event) => {
                const navBar = document.querySelector('#navbar')
                const scrollThreshold = 66;
                if (window.scrollY > scrollThreshold) {
                    navBar.classList.add('fixed', 'top-0', 'left-0', 'right-0')
                    document.body.classList.add('pt-28')
                }

                if (window.scrollY < scrollThreshold) {
                    navBar.classList.remove('fixed', 'top-0', 'left-0', 'right-0')
                    document.body.classList.remove('pt-28')
                }
            }
        </script>
    </div>

    @include('layouts.footer')
</body>

</html>
