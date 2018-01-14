<?php

namespace Tests\Feature;

use App\Services\KissScraper;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KissScraperTest extends TestCase {
	/** @test */
	function it_can_get_latest_songs_played() {
    	$scraper = new KissScraper();

    	$results = $scraper->fetchLatest();

    	$this->assertEquals(200, $results->getStatusCode());

    	$data = $scraper->getLatestSongs();

    	$this->assertNotNull($data);
	}
}
