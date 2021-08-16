<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\CronJobs\PautasEndDate;

class EndVotesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'votes:finaldate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command check which pautas are in the final_date. It updates their status to 1 and, check if it won or lose.';

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
     * @return int
     */
    public function handle()
    {
        PautasEndDate::endingVotes();
    }
}
