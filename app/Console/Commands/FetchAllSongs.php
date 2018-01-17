<?php

namespace App\Console\Commands;

use App\Scrapers\KissScraper;
use Illuminate\Console\Command;

class FetchAllSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:all {--page= : The Page ID to start at}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all songs from the KISS API';

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
     */
    public function handle()
    {
    	$page = $this->option('page');

        $this->info("Fetching ...");

        $scraper = new KissScraper();
        $scraper->getAllSongs(empty($page) ? 1 : $page);

        $this->info("Fetch complete.");
    }
}
