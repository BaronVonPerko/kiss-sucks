<?php

namespace App\Console\Commands;

use App\Scrapers\DiscogsScraper;
use App\Song;
use Illuminate\Console\Command;

class FetchReleaseYears extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:releases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the release years for a batch of songs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$this->info('Fetching release years');

        $scraper = new DiscogsScraper();
	    $songs = Song::whereNull('release_year')->take(10)->get();

	    if($songs->count() == 0) {
	    	$this->info('No songs to look up.');
	    	return;
	    }

	    foreach($songs as $song) {
		    $results = $scraper->search($song->artist, $song->title);
		    if(empty($results['results'])) continue;

		    if(!array_key_exists('year', $results['results'][0])) {
			    $this->updateReleaseYear($song, 'UNKNOWN');
		    }

		    $releaseYear = $results['results'][0]['year'];

		    $this->info("Updating $song->title with date of $releaseYear");

		    $this->updateReleaseYear($song, $releaseYear);
	    }

	    $this->info('Complete');
    }

    private function updateReleaseYear($song, $releaseYear) {
	    Song::whereArtist($song->artist)
	        ->whereTitle($song->title)
	        ->update(['release_year' => $releaseYear]);
    }
}
