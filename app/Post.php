<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use Voteable, Commentable, SoftDeletes;

    protected $guarded = [];

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Find site name with regex and put it in $all_post_with_user
     */
    public function siteName()
    {
        $site_name_pattern = '/([a-zA-Z0-9]([a-zA-Z0-9\-]{0,65}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}/m';
        preg_match_all($site_name_pattern, $this->link, $matches);
        try {
            $out = $matches[0][0];
        } catch (Exception $e) {
            $out = ' ';
        }
        return $out;

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

    public function isTrashed()
    {
        return $this->deleted_at != null;
    }

}
