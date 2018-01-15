<?php

namespace App\Console\Commands;

use App\Services\CalculateStatsService;
use Illuminate\Console\Command;

class CalculateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate stats based on songs in database';

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
        new CalculateStatsService();
    }
}
