<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies()
        ]);

        $reponse = $this->get(route('movies.index'));

        // $reponse->assertSuccessful();
        $reponse->assertSee('Popular Movies');
        $reponse->assertSee('Fake Now Playing Movies Title');
    }

    protected function fakePopularMovies()
    {
        return  Http::response(['results' => [
            "popularity" => 508.002,
            "vote_count" => 54,
            "video" => false,
            "poster_path" => "/4BgSWFMW2MJ0dT5metLzsRWO7IJ.jpg",
            "id" => 726739,
            "adult" => false,
            "backdrop_path" => "/t22fWbzdnThPseipsdpwgdPOPCR.jpg",
            "original_language" => "en",
            "original_title" => "Cats & Dogs 3: Paws Unite",
            "genre_ids" => [
                0 => 28,
                1 => 35
            ],
            "title" => "Fake Popular Movie Title",
            "vote_average" => 6.5,
            "overview" => "It's been ten years since the creation of the Great Truce, an elaborate joint-species surveillance system designed and monitored by cats and dogs to keep the peace when conflicts arise. But when a tech-savvy villain hacks into wireless networks to use frequencies only heard by cats and dogs, he manipulates them into conflict and the worldwide battle between cats and dogs is BACK ON. Now, a team of inexperienced and untested agents will have to use their old-school animal instincts to restore order and peace between cats and dogs everywhere.",
            "release_date" => "2020-10-02"
        ]], 200);
    }

    protected function fakeNowPlayingMovies()
    {
        return  Http::response(["results" => [
            "popularity" => 508.002,
            "vote_count" => 54,
            "video" => false,
            "poster_path" => "/4BgSWFMW2MJ0dT5metLzsRWO7IJ.jpg",
            "id" => 726739,
            "adult" => false,
            "backdrop_path" => "/t22fWbzdnThPseipsdpwgdPOPCR.jpg",
            "original_language" => "en",
            "original_title" => "Cats & Dogs 3: Paws Unite",
            "genre_ids" => [
                0 => 28,
                1 => 35
            ],
            "title" => "Fake Now Playing Movies Title",
            "vote_average" => 6.5,
            "overview" => "It's been ten years since the creation of the Great Truce, an elaborate joint-species surveillance system designed and monitored by cats and dogs to keep the peace when conflicts arise. But when a tech-savvy villain hacks into wireless networks to use frequencies only heard by cats and dogs, he manipulates them into conflict and the worldwide battle between cats and dogs is BACK ON. Now, a team of inexperienced and untested agents will have to use their old-school animal instincts to restore order and peace between cats and dogs everywhere.",
            "release_date" => "2020-10-02"
        ]], 200);
    }
}
