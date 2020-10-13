<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class TVShowViewModel extends ViewModel
{
    public $tv;
    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv(): Collection
    {
        return collect($this->tv)->merge([
            'poster_path' => "https://image.tmdb.org/t/p/w500/" . $this->tv['poster_path'],
            'vote_average' => $this->tv['vote_average'] * 10,
            'first_air_date' => Carbon::parse($this->tv['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tv['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tv['credits']['crew'])->take(2),
            'cast' => collect($this->tv['credits']['cast'])->take(5),
            'images' => collect($this->tv['images']['backdrops'])->take(9),
        ])->only([
            'id', 'poster_path', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres', 'cast', 'credits', 'videos', 'images', 'crew', 'created_by'
        ]);
    }
}
