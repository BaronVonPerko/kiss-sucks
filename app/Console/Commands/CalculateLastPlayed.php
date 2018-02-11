<?php

namespace App\Console\Commands;

use App\Services\CalculateLastPlayedService;
use App\Services\CalculateStatsService;
use App\Services\CalculateTopArtistsService;
use Illuminate\Console\Command;

class CalculateLastPlayed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:lastplayed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the last time all the songs were played';

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
        new CalculateLastPlayedService();
    }
}
