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

		foreach ( $mostPlayedArtists as $artist ) {
			$timesPlayed = Song::whereArtist( $artist )->count();

			$percent = number_format( $timesPlayed / $totalSongs * 100, 2 );

			$lastPlayed = Song::whereArtist($artist)->orderBy('time_played', 'desc')->take(2)->get();

			$artists[] = [ 'name' => $artist, 'percent' => $percent, 'last_played' => $lastPlayed[1]->time_played ];
		}

		TopArtist::truncate();
		TopArtist::insert( $artists );
	}

	static function getTopArtists() {
		$topArtists = TopArtist::get();

		$topArtists->map(function ($artist) {
			$artist['image'] = Song::whereArtist($artist->name)->first()->song_url;
			return $artist;
		});

		$topArtistsTotalPercent = 0;
		foreach ( $topArtists as $artist ) {
			$topArtistsTotalPercent += $artist->percent;
		}

		return ["list" => $topArtists, "totalPercent" => $topArtistsTotalPercent];
	}
}