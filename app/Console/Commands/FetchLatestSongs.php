<?php

namespace App\Console\Commands;

use App\Services\KissScraper;
use Illuminate\Console\Command;

class FetchLatestSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:latest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the latest songs from the KISS API';

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
        $scraper = new KissScraper();

        $scraper->getLatestSongs();

        $this->info("Latest songs fetched.");
    }
}
