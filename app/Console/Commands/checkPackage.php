<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Package;
use Carbon\Carbon;
class checkPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkpackage:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check package end date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $packages = Package::with("users")->get();
        $dt = Carbon::now();
        $today = $dt->toDateString();
        foreach($packages as $pk){
            foreach($pk->users as $user){
                if($user->pivot->end_date <= $today &&  $user->pivot->status=="active")
                $user->pivot->update(['status'=>'expired']);
            }
        }
    }
}
