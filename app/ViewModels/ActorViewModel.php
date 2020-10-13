<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor, $socials, $credits;
    public function __construct($actor, $socials, $credits)
    {
        $this->actor = $actor;
        $this->socials = $socials;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)
            ->merge([
                'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
                'age' => Carbon::parse($this->actor['birthday'])->age,
                'pob' => $this->actor['place_of_birth'],
                'profile_path' =>  $this->actor['profile_path'] ? "https://image.tmdb.org/t/p/w300/" . $this->actor['profile_path'] : "https://ui-avatars.com/api/?size=2356&name=" . $this->actor['name'],
            ]);
    }

    public function socials()
    {
        return collect($this->socials)->merge([
            "twitter" => $this->socials['twitter_id'] ? 'https://twitter.com/' . $this->socials['twitter_id'] : null,
            "instagram" => $this->socials['instagram_id'] ? 'https://instagram.com/' . $this->socials['instagram_id'] : null,
            "facebook" => $this->socials['facebook_id'] ? 'https://facebook.com/' . $this->socials['facebook_id'] : null,
        ]);
    }

    public function knownForMovies()
    {
        $castMovies  = collect($this->credits)->get('cast');
        return collect($castMovies)
            ->sortByDesc('popularity')
            ->take(5)
            ->map(function ($movie) {
                if (isset($movie['title'])) {
                    $title = $movie['title'];
                } elseif (isset($movie['name'])) {
                    $title = $movie['name'];
                } else {
                    $title = 'Untitled';
                }
                return collect($movie)->merge([
                    'poster_path' =>  $movie['poster_path'] ? "https://image.tmdb.org/t/p/w185/" . $movie['poster_path'] : "https://via.placeholder.com/185x278",
                    'title' => $title,
                    'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
                ]);
            });
    }

    public function credits()
    {
        $castMovies  = collect($this->credits)->get('cast');

        return collect($castMovies)
            ->map(function ($movie) {
                if (isset($movie['release_date'])) {
                    $releaseDate = $movie['release_date'];
                } elseif (isset($movie['first_air_date'])) {
                    $releaseDate = $movie['first_air_date'];
                } else {
                    $releaseDate = '';
                }

                if (isset($movie['title'])) {
                    $title = $movie['title'];
                } elseif (isset($movie['name'])) {
                    $title = $movie['name'];
                } else {
                    $title = '';
                }

                return collect($movie)->merge([
                    'release_date' =>  $releaseDate,
                    'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title' => $title,
                    'character' => isset($movie['character'])  ? $movie['character'] : ''
                ]);
            })
            ->sortByDesc('release_date');
    }
}
