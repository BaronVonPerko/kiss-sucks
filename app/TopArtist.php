<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopArtist extends Model
{
    protected $guarded = [];

    protected $dates = ['last_played'];
}
