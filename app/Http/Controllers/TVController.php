<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TVViewModel;
use App\ViewModels\TVShowViewModel;
use Illuminate\Support\Facades\Http;

class TVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTV = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        $popularTV = collect($popularTV)->take(10);

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $topRated = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $viewModal = new TVViewModel($popularTV, $topRated, $genres);
        return view('tv.index', $viewModal);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        return view('tv.show', new TVShowViewModel($tv));
    }
}
