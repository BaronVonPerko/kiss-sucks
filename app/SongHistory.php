<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongHistory extends Model
{
    protected $guarded = [];


    function scopeFindInstance($query, $artist, $title, $timestamp) {
    	return $query->whereArtist($artist)
		               ->whereTitle($title)
		               ->whereTimePlayed($timestamp);
    }
}
