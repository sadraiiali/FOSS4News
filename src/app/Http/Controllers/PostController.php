<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use App\Site;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
        $all_post_with_user = Post::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'DESC')
            ->with('user')
            ->paginate(30);

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
        $comments = $post->comments()
            ->orderBy('created_at', 'DESC')
            ->get();
//            ->paginate(5);
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments
        ]);
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
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $user = Auth::user();
        if ($user->role == 'ADMIN' || $user->id == $post->user_id) {
            try {
                $post->comments()->delete();
                $post->reports()->delete();
                $post->votes()->delete();
                $post->delete();
            } catch (Exception $e) {
                return redirect()->back()->withErrors(['msg' => __('errors.post.Unauthorized')]);
            }
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['msg' => __('errors.post.Unauthorized')]);
    }

    public function create_post(CreatePostRequest $request)
    {
        try {
            // check if site already exists assign $siteId to intended site id
            $siteName = Post::findSiteName($request->link);
            if ($siteName == '') {
                // TODO: error handling problem
                return view('posts.create', ['error' => true]);
            }
            $siteId = Site::Where('domain', $siteName)->first()->id;
        } catch (Exception $e) {
            // if site already not exists, create it and assign $siteId to intended site id
            $siteId = Site::create([
                'domain' => $siteName
            ])->id;
        }

        try {
            Auth::user()->posts()->create([
                'uri' => Post::findUri($request->title),
                'title' => $request->title,
                'body' => $request->body,
                'link' => $request->link,
                'site_id' => $siteId,
            ]);
            return redirect('/')->with('success', 'پست شما ساخته شد');
        } catch (Exception $e) {
            return view('posts.create', ['error' => true]);
        }

        return redirect('today');
    }


    /**
     * function to send all posts in a json response for API
     * 
     * @return Response
     */
    public function getAllPosts() {
        $allPosts = Post::orderBy('created_at', 'DESC')->with('user')->get();

        return Response()->json(
            [
                'status' => 200,
                'data' => ['posts' => $allPosts]
            ],
            200
        );
    }

}
