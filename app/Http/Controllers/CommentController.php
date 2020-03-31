<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param String $comment
     * @param dynamic $commentable
     * @return RedirectResponse
     */
    public function store($commentable, String $comment)
    {
        if ($commentable->comment($comment)) {
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['msg' => __('errors.comment.problem')]);
    }

    /**
     * Store new Comment for Post object.
     *
     * @param Post $post
     * @param CreateCommentRequest $request
     * @return RedirectResponse
     */
    public function commentPost(Post $post, CreateCommentRequest $request)
    {
        return $this->store($post, $request->body);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
