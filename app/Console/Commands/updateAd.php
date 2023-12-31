<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class updateAd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updatead:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update ad end date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
