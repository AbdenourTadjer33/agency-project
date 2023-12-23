<x-app-layout>
    <div class="mt-10 mx-8">

        @foreach ($hotels as $hotel)
                <a href="{{ route('hotel.show', ['slug' => $hotel->slug]) }}"
                    class="underline text-blue-500">{{ $hotel->name }}</a>
        @endforeach
    </div>



</x-app-layout>
