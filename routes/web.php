<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostController@index')->name('all_posts');
Route::get('/today', 'PostController@today')->name('today');

Route::get('/p/{post:uri}', 'PostController@show')->name('show_post');

// User Space
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/new', 'PostController@create')->name('new');
    Route::post('/new', 'PostController@create_post')->name('create_post');
    Route::get('/p/{post:uri}/report', 'ReportController@create')->name('post_report');
    Route::post('/p/{post:uri}/report', 'ReportController@store')->name('create_post_report');

    Route::post('/p/{post:uri}/c', 'CommentController@store')
        ->name('post.comment');

    Route::get('/p/{post:uri}/v/{reaction}', 'VoteController@votePost')
        ->where('reaction', '[0-1]')
        ->name('post.vote');
});


Auth::routes();

