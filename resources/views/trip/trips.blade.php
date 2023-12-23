<x-app-layout>

    <div class="mt-10 mx-8">
        @foreach ($trips as $trip)
            <a href="{{ route('trip.show', ['slug' => $trip->slug]) }}"
                class="underline text-blue-500 ">{{ $trip->name }}</a>
        @endforeach
    </div>
</x-app-layout>
