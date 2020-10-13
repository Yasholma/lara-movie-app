<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $nowPlayingMovies, $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies(): Collection
    {
        return $this->renderMovies($this->popularMovies);
    }

    public function nowPlayingMovies(): Collection
    {
        return $this->renderMovies($this->nowPlayingMovies);
    }

    public function genres(): Collection
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function renderMovies($movieType)
    {
        return collect($movieType)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(", ");
            return collect($movie)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500/" . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10,
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ])->only([
                'id', 'poster_path', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres'
            ]);
        });
    }
}
