<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public static $reasons = ['ABUSE', 'SPAM', 'PORN', 'OTHER'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportable()
    {
        return $this->morphTo();
    }
}
