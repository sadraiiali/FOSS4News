<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['domain'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
