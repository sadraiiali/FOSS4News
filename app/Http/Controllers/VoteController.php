<?php

namespace App\Http\Controllers;

use App\Post;
use App\Vote;
use Exception;
use Illuminate\Http\RedirectResponse;
use Ramsey\Uuid\Type\Integer;

class VoteController extends Controller
{
    /**
     * function to handle voting and add vote to database
     *
     * NOTE: reaction can have just to values: 1 (UpVote), 2 (DownVote)
     * @param $voteable
     * @param int $reaction
     * @return RedirectResponse
     */
    public function store($voteable, int $reaction)
    {
        if ($voteable->vote($reaction)) {
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['msg' => __('errors.vote.problem')]);
        }
    }

    /**
     * function to handle voting for Posts
     *
     * NOTE: reaction can have just to values: 1 (UpVote), 2 (DownVote)
     * @param Post $post
     * @param int $reaction
     * @return RedirectResponse
     */
    public function votePost(Post $post, int $reaction)
    {
        return $this->store($post, $reaction);
    }
}
