<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['prefix' => 'movies', 'middleware'=>'auth:api'], function(){
    Route::get('popular/{page?}', 'MoviesController@popular');
    Route::get('favorites/{page?}', 'MoviesController@favorites');
    Route::put('toggle-favorite/{movie_id}', 'MoviesController@toggleFavorite');
    Route::get('movie/{movie_id}', 'MoviesController@movieInfo');
});
