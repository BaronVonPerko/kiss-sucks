<?php

namespace App\Http\Controllers;

use App\Services\CalculateTopArtistsService;
use App\Song;
use App\Stat;
use App\TopArtist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayDashboard extends Controller {
	public function __invoke() {
		$stats = Stat::Latest()->first();

		$songs      = Song::Latest( 10 )->get();
		$topArtists = CalculateTopArtistsService::getTopArtists();

		return view( 'dashboard', [
			'songs'                  => $songs,
			'oldest'                 => $stats->oldest_date,
			'songCount'              => $stats->total_songs,
			'uniqueArtists'          => $stats->unique_artists,
			'topArtists'             => $topArtists["list"],
			'topArtistsTotalPercent' => $topArtists["totalPercent"],
			'uniqueSongs'            => $stats->unique_songs,
			'oldestRelease'          => $stats->oldest_release,
			'newestRelease'          => $stats->newest_release,
		] );
	}
}
