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
    return view('home');
});

Route::group(['prefix' => 'api/v1.1'], function () {

    Route::resource('users', 'UserController', ['only' =>[
        'store'
    ]]);
    
//    Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'api']], function () {
//        Route::resource('users', 'UserController');
//        Route::resource('albums', 'AlbumController');
//    });

    Route::group(['middleware' => ['api']], function () {

        Route::resource('users','UserController',['only' =>[
        'show', 'update', 'destroy'
        ]]);

        Route::resource('albums', 'AlbumController', ['only' =>[
            'index', 'store', 'show', 'update', 'destroy'
        ]]);
    });

});
