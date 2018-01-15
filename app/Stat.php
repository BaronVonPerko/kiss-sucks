<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $guarded = [];

    function scopeLatest($query) {
	    return $query->orderBy('created_at', 'desc')->take(1);
    }

}
