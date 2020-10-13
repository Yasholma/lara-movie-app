@extends('layouts.main')

@section('content')
<div class="container px-4 mx-auto pt-16">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @forelse ($popularMovies as $movie)
            <x-movie-card :movie="$movie"></x-movie-card>
            @empty
            <p>No Movies</p>
            @endforelse
        </div>
    </div>

    <div class="now-playing py-24">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @forelse ($nowPlayingMovies as $movie)
            <x-movie-card :movie="$movie"></x-movie-card>
            @empty
            <p>No Movies Playing</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
