<?php

namespace App\Services;

use \App\Song;
use \App\Stat;

class CalculateStatsService {

	public function __construct() {
		self::calculate();
	}

	private function calculate() {
		$oldestDate    = Song::orderBy( 'time_played', 'asc' )->pluck( 'time_played' )->first();
		$songCount     = Song::count();
		$uniqueArtists = Song::select( 'artist' )->distinct()->get()->count();
		$uniqueSongs   = Song::select( [ 'artist', 'title' ] )->distinct()->get()->count();
		$oldestRelease = Song::where('release_year', '!=', 'UNKNOWN')->orderBy( 'release_year', 'asc' )->pluck( 'release_year' )->first();
		$newestRelease = Song::where('release_year', '!=', 'UNKNOWN')->orderBy( 'release_year', 'desc' )->pluck( 'release_year' )->first();

		Stat::create( [
			'total_songs'    => $songCount,
			'unique_songs'   => $uniqueSongs,
			'unique_artists' => $uniqueArtists,
			'oldest_date'    => $oldestDate,
			'oldest_release' => $oldestRelease,
			'newest_release' => $newestRelease,
		] );
	}


}