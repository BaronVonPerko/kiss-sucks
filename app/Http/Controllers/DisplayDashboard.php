<?php

namespace App\Http\Controllers;

use App\Song;
use App\Stat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayDashboard extends Controller {
	public function __invoke() {
		$stats = Stat::Latest()->first();

		$songs            = Song::Latest( 10 )->get();
//		$mostPlayedArtist = Song::select( 'artist' )->groupBy( 'artist' )->orderByRaw( 'count(*) desc' )->limit( 1 )->pluck( 'artist' )->first();

		return view( 'dashboard', [
			'songs'            => $songs,
			'oldest'           => $stats->oldest_date,
			'songCount'        => $stats->total_songs,
			'uniqueArtists'    => $stats->unique_artists,
//			'mostPlayedArtist' => $mostPlayedArtist,
			'uniqueSongs'      => $stats->unique_songs,
		] );
	}
}
