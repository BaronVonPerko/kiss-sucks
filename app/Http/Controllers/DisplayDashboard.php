<?php

namespace App\Http\Controllers;

use App\Song;
use App\Stat;
use App\TopArtist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayDashboard extends Controller {
	public function __invoke() {
		$stats = Stat::Latest()->first();

		$songs                  = Song::Latest( 10 )->get();
		$topArtists             = TopArtist::get();
		$topArtistsTotalPercent = 0;
		foreach ( $topArtists as $artist ) {
			$topArtistsTotalPercent += $artist->percent;
		}

		return view( 'dashboard', [
			'songs'                  => $songs,
			'oldest'                 => $stats->oldest_date,
			'songCount'              => $stats->total_songs,
			'uniqueArtists'          => $stats->unique_artists,
			'topArtists'             => $topArtists,
			'topArtistsTotalPercent' => $topArtistsTotalPercent,
			'uniqueSongs'            => $stats->unique_songs,
		] );
	}
}
