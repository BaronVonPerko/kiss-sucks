<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopArtist extends Model
{
    protected $guarded = [];

    public function getLastPlayedAttribute() {
        $song = Song::whereArtist($this->name)->orderBy('time_played', 'desc')->take(1)->first();

        return $song->time_played->diffForHumans();
    }
}
