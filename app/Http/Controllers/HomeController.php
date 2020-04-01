<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Auth::user()->posts()->paginate(30); // get all posts of user
        return view('home', [
            'posts' => $posts,
            'posts_count' => $posts->toArray()['total'],
            'last_page' => $posts->toArray()['last_page'],
            'current_page' => $posts->toArray()['current_page'],
        ]);
    }
}
