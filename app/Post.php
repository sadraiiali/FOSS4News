<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use Voteable;
    
    protected $guarded = [];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes()
    {
        return $this->morphTo(Vote::class, 'voteable');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function findUri($title)
    {
        $uri = Str::limit(md5($title), 4, '');
        $find = Post::where('uri', $uri)->get()->count();
        // unique uri
        while ($find != 0) {
            $uri = Str::random(5);
            $find = Post::where('uri', $uri)->get()->count();
        }
        return $uri;
    }

}
