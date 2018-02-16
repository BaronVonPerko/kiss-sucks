<?php

namespace App\Http\Controllers;

use App\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FetchSongData extends Controller
{
    public function __invoke(Request $request, $artist, $title) {

    	$songThisMonth = Song::whereArtist($artist)->whereTitle($title)->whereMonth('time_played', '=', date('m'))->count();
    	$songLastMonth = Song::whereArtist($artist)->whereTitle($title)->whereMonth('time_played', '=', Carbon::now()->subMonth()->format('m'))->count();
    	$artistThisMonth = Song::whereArtist($artist)->whereMonth('time_played', '=', date('m'))->count();
    	$artistLastMonth = Song::whereArtist($artist)->whereMonth('time_played', '=', Carbon::now()->subMonth()->format('m'))->count();

	    return [
		    "songThisMonth"   => $songThisMonth,
		    "songLastMonth"   => $songLastMonth,
		    "artistThisMonth" => $artistThisMonth,
		    "artistLastMonth" => $artistLastMonth,
	    ];
    }
}
