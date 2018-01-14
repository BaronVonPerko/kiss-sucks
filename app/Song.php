<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {
	protected $guarded = [];


	function scopeFindInstance( $query, $artist, $title, $timestamp ) {
		return $query->whereArtist( $artist )
		             ->whereTitle( $title )
		             ->whereTimePlayed( $timestamp );
	}


	function scopeLatest( $query, $number = 10 ) {
    	return $query->orderBy('time_played', 'desc')->take($number);
	}
}
