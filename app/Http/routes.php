<?php

Route::group(['prefix' => 'api/v1.1'], function () {
    /**
     * Password reset routes
     */
        Route::post('reset', 'PasswordResetController@store');
        Route::put('reset', 'PasswordResetController@update');

    /**
     * Authentication routes
     */
        Route::post('authenticate', 'TokenController@authenticate');
        Route::get('refresh', 'TokenController@refresh');
        Route::get('logout', 'TokenController@logout');
        Route::get('authenticate/user', 'TokenController@getAuthenticatedUser');

    /**
     * Users objects routes
     */
        Route::resource('users','UserController',['only' =>[
            'index', 'show', 'update', 'destroy', 'store'
        ]]);

        // Get the user albums list
        Route::get('users/{users}/albums', 'UserController@getUserAlbums');

    /**
     * Albums objects routes
     */
        Route::resource('albums', 'AlbumController', ['only' =>[
            'index', 'store', 'show', 'update', 'destroy'
        ]]);

    /**
     * Photos object routes
     */
        Route::resource('photos', 'PhotoController', ['only' =>[
            'index', 'store', 'show', 'destroy'
        ]]);

        // Get the miniatures of photo
        Route::get('photos/{photo}/resized', 'PhotoController@resized');
});
