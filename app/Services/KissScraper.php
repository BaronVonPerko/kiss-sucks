<?php

namespace App\Services;

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
	 *
	 * @return string
	 */
	function getLatestSongs() {
		return $this->fetchLatest()->getBody()->getContents();
	}

}