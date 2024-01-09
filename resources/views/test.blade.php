<x-app-layout>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    @php

        $assets = $trip->assets;
        if (!is_array($assets)) {
            $assets = json_decode($assets, true);
        }

        $formule_meaning = [
            'LPD' => 'Petit déjuner',
            'LDP' => 'Demi pension',
            'LPC' => 'Pension compléte',
        ];
    @endphp

    <section class="flex flex-col sm:flex-row mt-10 mx-5 sm:mx-10">
        <div class="w-full mr-0 sm:w-2/5 sm:mr-12">
            <img src="{{ asset('storage/' . $assets[0]['path']) }}" width="100%" id="main-img" class="rounded-lg"
                alt="">

            <div class="flex justify-between gap-1 pt-2.5">
                @foreach ($assets as $asset)
                    <div class="basis-[24%] cursor-pointer">
                        <img src="{{ asset('storage/' . $asset['path']) }}" width="100%" class="h-full rounded-sm"
                            alt="">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-full sm:w-1/2 pt-8">
            <h6 class="uppercase text-xs font-bold text-slate-400 pb-2">{{ $trip->tripCategory->name }}</h6>
            <h2 class="capitalize text-2xl pb-4 text-slate-900 font-bold ">{{ $trip->name }}</h2>
            {{-- destination --}}
            <div class="flex items-center">
                <svg class="w-4 h-4 text-slate-900 dark:text-white me-2" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 21">
                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path
                            d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                    </g>
                </svg>
                <span class="font-bold">{{ $trip->destination . ', ' . $trip->city }}</span>
            </div>
            {{-- hotel naem --}}
            <h3 class="text-base text-slate-900 capitalize font-bold flex items-center">
                {{ $trip->hotel->name }}
                <span class="flex items-center ms-4">
                    @for ($i = 0; $i < $trip->hotel->classification; $i++)
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    @endfor
                    @for ($i = 0; $i < 5 - $trip->hotel->classification; $i++)
                        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    @endfor
                </span>
            </h3>
            {{-- duration --}}
            <h3 class="text-base text-slate-900 capitalize font-bold ">
                {{ $trip->tripDates[0]->getDuration() . ' Jours et ' . $trip->tripDates[0]->getDuration() - 1 . ' Nuitée' }}
            </h3>
            {{-- pricing --}}
            <h3 class="text-base text-slate-900 capitalize">à partir de <span
                    class="text-slate-900 font-bold">{{ $trip->pricing->price_adult . 'DA' }}</span></h3>
            {{-- description --}}
            <blockquote class="p-2 my-2 border-s-2 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                <p class="text-base leading-4 text-gray-900 dark:text-white" x-ref="description" x-transition
                    data-description="{!! $trip->description !!}" data-mindescription="{!! Str::limit($trip->description, 70) !!}">
                    {!! Str::limit($trip->description, 90) !!}
                </p>
                <span x-ref="more" 
                    x-on:click="$refs.description.innerText = $refs.description.dataset.description; $el.classList.add('hidden'); $refs.less.classList.remove('hidden')"
                    class="more select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Plus
                </span>
                <span x-ref="less"
                    x-on:click="$refs.description.innerText = $refs.description.dataset.mindescription; $el.classList.add('hidden'); $refs.more.classList.remove('hidden')"
                    class="less hidden select-none cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Moins
                </span>
            </blockquote>

        </div>
    </section>

</x-app-layout>
