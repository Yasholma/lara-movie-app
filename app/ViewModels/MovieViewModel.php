<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' =>  $this->movie['poster_path'] ? "https://image.tmdb.org/t/p/w500/" . $this->movie['poster_path'] : "https://via.placeholder.com/185x278",
            'vote_average' => $this->movie['vote_average'] * 10,
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'images' => collect($this->movie['images']['backdrops'])->take(9),
        ])->only([
            'id', 'poster_path', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'cast', 'credits', 'videos', 'images', 'crew'
        ]);
    }
}
