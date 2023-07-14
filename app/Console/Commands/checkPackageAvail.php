<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class checkPackageAvail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkpackageavail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check availability package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $packages = Package::with("categories")->get();
        $dt = Carbon::now();
        $today = $dt->toDateString();
        foreach($packages as $pk){
            $exp = $pk->created_at + $pk->validity_days;
            if($exp>= $today &&  $pk->validity_days=="available")
                $pk->update(['validity_days'=>'unavailable']);
        }
    }
}
