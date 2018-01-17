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

	    foreach($songs as $song) {
		    $results = $scraper->search($song->artist, $song->title);
		    $releaseYear = $results['results'][0]['year'];

		    $this->info("Updateing $song->title with date of $releaseYear");

		    Song::whereArtist($song->artist)
		        ->whereTitle($song->title)
			    ->update(['release_year' => $releaseYear]);
	    }

	    $this->info('Complete');
    }
}
