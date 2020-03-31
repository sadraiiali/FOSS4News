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

    Route::post('/p/{post:uri}/c', 'CommentController@commentPost')
        ->name('post.comment');

    Route::get('/p/{post:uri}/d', 'PostController@destroy')
        ->name('post.delete');

    Route::get('/p/{post:uri}/v/{reaction}', 'VoteController@votePost')
        ->where('reaction', '[0-1]')
        ->name('post.vote');
});


// Admin Space
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/users', 'AdminController@showUsers')->name('admin.users');
    Route::get('/users/{user:id}/d', 'AdminController@deleteUser')->name('admin.users.delete');
    Route::get('/users/{user:id}/a', 'AdminController@makeAdmin')->name('admin.users.make_admin');

    Route::get('/posts', 'AdminController@showPosts')->name('admin.posts');
    Route::get('/posts/{post:id}/d', 'AdminController@deletePost')->name('admin.posts.delete');

    Route::get('/reports', 'AdminController@index')->name('admin.reports');
    Route::get('/pages', 'AdminController@index')->name('admin.pages');
});

Auth::routes();
