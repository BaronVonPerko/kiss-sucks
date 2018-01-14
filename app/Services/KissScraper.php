<?php

namespace App\Services;

use App\SongHistory;
use GuzzleHttp\Client;

class KissScraper {

	// http://lsp-prod.cmgdigital.com/api/v1/station/history/?domain=kissrocks.com&page=1&is_song=True&format=json

	protected $client = null;

	function __construct() {
		$this->client = new Client( [
			'base_uri' => 'http://lsp-prod.cmgdigital.com/api/v1/'
		] );
	}

	/**
	 * GuzzleHTTP Request to KISS API
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	function fetchLatest() {
		return $this->client->request(
			'GET',
			'station/history/',
			[
				'query' => [
					'domain'  => 'kissrocks.com',
					'page'    => 1,
					'is_song' => 'True',
					'format'  => 'json',
				]
			] );
	}


	/**
	 * Get the latest songs in JSON format
	 * and store them into our database.
	 *
	 * @return string
	 */
	function getLatestSongs() {
		$songs = json_decode( $this->fetchLatest()->getBody()->getContents(), true );

		foreach ( $songs['results'] as $song ) {
			$existing = SongHistory::FindInstance(
				$song['track_artist'],
				$song['track_title'],
				$song['timestamp_iso']
			)->first();

			if(!$existing) {
				SongHistory::create( [
					'artist'      => $song['track_artist'],
					'title'       => $song['track_title'],
					'time_played' => $song['timestamp_iso']
				] );
			}
		}
	}

}