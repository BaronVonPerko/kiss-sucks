<?php

namespace App\Services;

use App\Song;
use App\TopArtist;

class CalculateTopArtistsService {

	public function __construct() {
		self::calculate();
	}

	private function calculate() {
		$mostPlayedArtists = Song::select( 'artist' )->groupBy( 'artist' )->orderByRaw( 'count(*) desc' )->limit( 5 )->pluck( 'artist' );

		$totalSongs = Song::count();

		$artists = [];

		foreach($mostPlayedArtists as $artist) {
			$timesPlayed = Song::whereArtist($artist)->count();

			$percent = number_format($timesPlayed / $totalSongs * 100, 2);

			$artists[] = ['name' => $artist, 'percent' => $percent];
		}

		TopArtist::truncate();
		TopArtist::insert($artists);
	}
}