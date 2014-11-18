<?php

Route::get('/', 'AuthController@getIndex');
Route::get('gauth/{auth?}', array('as' => 'googleAuth', 'uses' => 'AuthController@getGoogleLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLoggedOut'));