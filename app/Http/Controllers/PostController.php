<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $page = 1;
        if (isset($request['page'])) {
            $page = $request['page'];
        }
        
        $all_post_with_user = Post::where([])->orderBy('created_at', 'DESC')->with('user')->paginate(30);
        
        $is_end = false;
        if ($all_post_with_user->lastPage() == $page) {
            $is_end = true;
        }

        // find site name with regex and put it in $all_post_with_user 
        $site_name_pattern = '/([a-zA-Z0-9]([a-zA-Z0-9\-]{0,65}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}/m';
        foreach ($all_post_with_user as $post) {
            preg_match_all($site_name_pattern, $post->link, $matches);
            $post['site_name'] = $matches[0][0];
        }

        return view('all_posts', [
            'posts' => $all_post_with_user,
            'page' => $request['page'],
            'is_end' => $is_end
        ]);
    }

    /**
     * Display a today's Posts
     *
     * @param Request $request
     * @return Factory|View
     */
    public function today(Request $request)
    {
        $page = 1;
        if (isset($request['page'])) {
            $page = $request['page'];
        }
        $all_post_with_user = Post::whereDate('created_at', Carbon::today())->with('user')->paginate(30);

        $is_end = false;
        if ($all_post_with_user->lastPage() == $page) {
            $is_end = true;
        }
        return view('all_posts', [
            'posts' => $all_post_with_user,
            'page' => $request['page'],
            'is_end' => $is_end
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Factory|View
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->paginate(5);
        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function create_post(CreatePostRequest $request)
    {
        try {
            Auth::user()->posts()->create([
                'uri' => Post::findUri($request->title),
                'title' => $request->title,
                'body' => $request->body,
                'link' => $request->link,
            ]);
            return redirect('/')->with('success', 'پست شما ساخته شد');
        } catch (Exception $e) {
            return view('posts.create', ['error' => true]);
        }

        return redirect('today');
    }

}
