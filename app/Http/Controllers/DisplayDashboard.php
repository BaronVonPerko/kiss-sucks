<?php

namespace App\Http\Controllers;

use App\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayDashboard extends Controller {
	public function __invoke() {
		$songs            = Song::Latest( 10 )->get();
		$oldestDate       = Song::orderBy( 'time_played', 'asc' )->pluck( 'time_played' )->first();
		$songCount        = Song::count();
		$uniqueArtists    = Song::select( 'artist' )->distinct()->get()->count();
		$mostPlayedArtist = Song::select( 'artist' )->groupBy( 'artist' )->orderByRaw( 'count(*) desc' )->limit( 1 )->pluck( 'artist' )->first();
		$uniqueSongs      = Song::select( [ 'artist', 'title' ] )->distinct()->get()->count();

		return view( 'dashboard', [
			'songs'            => $songs,
			'oldest'           => Carbon::parse( $oldestDate )->toDateString(),
			'songCount'        => $songCount,
			'uniqueArtists'    => $uniqueArtists,
			'mostPlayedArtist' => $mostPlayedArtist,
			'uniqueSongs'      => $uniqueSongs,
		] );
	}
}
