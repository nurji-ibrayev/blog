<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\NavigationController@home');

Route::get('/reviews', 'App\Http\Controllers\NavigationController@reviews');

Route::post('/reviews/review_check', 'App\Http\Controllers\NavigationController@review_check');

Route::get('/about', 'App\Http\Controllers\NavigationController@about');

Route::get('/contact', 'App\Http\Controllers\NavigationController@contact');

/*Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'ID: '.$id.', Name: '.$name;
});*/
