<?php

namespace App;

use App\Comment;
use Illuminate\Support\Facades\Auth;
use function Sodium\increment;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getCommentsCountAttribute()
    {
        // count number of comments of object
        return $this->comments->count();
    }

    public function comment(string $comment)
    {
        if ($user = Auth::user()) {

            $this->comments()->create(
                [
                    'user_id' => $user->id,
                    'body' => $comment,
                ]
            );
            $this->increment('comments_count');
            return true;
        }
        return false;
    }
}
