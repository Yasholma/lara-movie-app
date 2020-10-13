@extends('layouts.main')

@section('content')
<div class="container px-4 mx-auto pt-16">
    <div class="popular-tv">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @forelse ($popularTV as $tv)
            <x-tv-card :tv="$tv"></x-tv-card>
            @empty
            <p>No Shows</p>
            @endforelse
        </div>
    </div>

    <div class="top-rated-shows py-24">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @forelse ($topRated as $tv)
            <x-tv-card :tv="$tv"></x-tv-card>
            @empty
            <p>No Shows</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
