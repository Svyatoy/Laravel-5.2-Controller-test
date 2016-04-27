<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return phpinfo();
});

Route::group(['prefix' => 'api/v1.1'], function () {

    Route::post('authenticate', 'TokenController@authenticate');
    Route::get('refresh', 'TokenController@refresh');
    Route::get('logout', 'TokenController@logout');
    Route::get('authenticate/user', 'TokenController@getAuthenticatedUser');

    Route::resource('users','UserController',['only' =>[
        'index', 'show', 'update', 'destroy', 'store'
    ]]);
    Route::get('users/{users}/albums', 'UserController@getUserAlbums');

    Route::resource('albums', 'AlbumController', ['only' =>[
        'index', 'store', 'show', 'update', 'destroy'
    ]]);

});
