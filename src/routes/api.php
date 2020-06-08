<?php

use Illuminate\Support\Facades\Route;

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

// Authorization Routes
Route::group(
    ['prefix' => 'auth'],
    function () {
        Route::post('login', 'Auth\AuthController@login');
        Route::post('register', 'Auth\AuthController@register');

        Route::group(
            ['middleware' => 'auth:api'],
            function () {
                Route::get('logout', 'Auth\AuthController@logout');
                Route::get('user', 'Auth\AuthController@user');
            });
    }
);

Route::get('/posts', 'PostController@getAllPosts');
