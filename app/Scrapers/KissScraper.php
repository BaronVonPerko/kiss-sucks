<?php

namespace App\Scrapers;

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
	 * @param int $page
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	function fetchLatest( $page = 1 ) {
		return $this->client->request(
			'GET',
			'station/history/',
			[
				'query' => [
					'domain'  => 'kissrocks.com',
					'page'    => $page,
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

		$this->parseSongs( $songs );
	}


	/**
	 * Fetch all songs from the API to
	 * as far back as possible.
	 */
	function getAllSongs() {
		$page = 1;

		while ( $page ) {
			echo "Fetching Page $page\r\n";

			$songs = json_decode( $this->fetchLatest( $page )->getBody()->getContents(), true );

			$this->parseSongs( $songs );

			if($songs['next']) {
				$page += 1;
			} else {
				$page = false;
			}
		}
	}

	/**
	 * @param $songs
	 */
	public function parseSongs( $songs ) {
		foreach ( $songs['results'] as $song ) {
			$existing = SongHistory::FindInstance(
				$song['track_artist'],
				$song['track_title'],
				$song['timestamp_iso']
			)->first();

			if ( ! $existing ) {
				SongHistory::create( [
					'artist'      => $song['track_artist'],
					'title'       => $song['track_title'],
					'time_played' => $song['timestamp_iso']
				] );
			}
		}
	}

}