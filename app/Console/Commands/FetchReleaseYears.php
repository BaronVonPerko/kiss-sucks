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
        $scraper = new DiscogsScraper();
	    $songs = Song::first();
	    $results = $scraper->search($songs->artist, $songs->title);

	    dd($results['results'][0]['year']);
    }
}