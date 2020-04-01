<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Commentable;

    protected $guarded = [];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes()
    {
        return $this->morphTo(Vote::class, 'voteable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
