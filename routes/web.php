<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MovieController@index')->name('movies.index');
route::get('/movies/{id}', 'MovieController@show')->name('movies.show');

Route::get('/actors', 'ActorController@index')->name('actors.index');
route::get('/actors/{id}', 'ActorController@show')->name('actors.show');

Route::get('/actors/page/{page?}', 'ActorController@index');

Route::get('/tv', 'TVController@index')->name('tv.index');
route::get('/tv/{id}', 'TVController@show')->name('tv.show');
