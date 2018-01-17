<?php

namespace App\Scrapers;

use GuzzleHttp\Client;

class DiscogsScraper {

	//https://api.discogs.com/database/search?artist=Metallica&track=Sandman&key=paJGGzZOIreqXDdLYzAd&secret=vqvZoMYsdLjkDaqpmsnclCevEfqjHbru

	protected $client = null;

	function __construct() {
		$this->client = new Client( [
			'base_uri' => 'https://api.discogs.com/'
		] );
	}

	function search($artist, $title) {
		$response = $this->client->request(
			'GET',
			'database/search',
			[
				'query' => [
					'artist' => $artist,
					'title' => $title,
					'key' => config('app.discogs_key'),
					'secret' => config('app.discogs_secret')
				]
			]
		);

		return json_decode($response->getBody()->getContents(), true);
	}

}