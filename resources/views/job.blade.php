<x-layout>
    <x-slot:heading>Jobs Listings</x-slot:heading>

    <h2 class="font-bold text-lg">{{$job['title']}}</h2>
    <p>
        This job pays {{$job['salary']}} yearly.
    </p>
</x-layout>
