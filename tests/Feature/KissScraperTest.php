<?php

namespace Tests\Feature;

use App\Services\KissScraper;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KissScraperTest extends TestCase {

	protected $scraper;

	protected function setUp() {
		parent::setUp();
		$this->scraper = new KissScraper();
	}


	/** @test */
	function it_can_get_latest_songs_played() {
    	$results = $this->scraper->fetchLatest();

    	$this->assertEquals(200, $results->getStatusCode());

    	$this->assertNotNull($results->getBody()->getContents());
	}

	/** @test */
	function it_does() {
		$this->scraper->getLatestSongs();
	}
}
