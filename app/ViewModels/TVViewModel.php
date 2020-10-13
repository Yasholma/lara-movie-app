<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class TVViewModel extends ViewModel
{
    public $popularTV, $topRated, $genres;
    public function __construct($popularTV, $topRated, $genres)
    {
        $this->popularTV = $popularTV;
        $this->topRated = $topRated;
        $this->genres = $genres;
    }

    public function popularTV(): Collection
    {
        return $this->renderTV($this->popularTV);
    }

    public function topRated(): Collection
    {
        return $this->renderTV($this->topRated);
    }

    public function genres(): Collection
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function renderTV($tvType)
    {
        return collect($tvType)->map(function ($tv) {
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(", ");
            return collect($tv)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500/" . $tv['poster_path'],
                'vote_average' => $tv['vote_average'] * 10,
                'first_air_date' => Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ])->only([
                'id', 'poster_path', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }
}
