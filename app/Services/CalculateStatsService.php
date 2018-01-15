<?php

namespace App\Services;

use \App\Song;
use \App\Stat;

class CalculateStatsService {

	protected $oldestDate, $songCount, $uniqueArtists, $uniqueSongs;

	public function __construct() {
		self::calculate();
	}

	protected function calculate() {
		$oldestDate    = Song::orderBy( 'time_played', 'asc' )->pluck( 'time_played' )->first();
		$songCount     = Song::count();
		$uniqueArtists = Song::select( 'artist' )->distinct()->get()->count();
		$uniqueSongs   = Song::select( [ 'artist', 'title' ] )->distinct()->get()->count();

		Stat::create( [
			'total_songs'    => $songCount,
			'unique_songs'   => $uniqueSongs,
			'unique_artists' => $uniqueArtists,
			'oldest_date'    => $oldestDate
		] );
	}


}