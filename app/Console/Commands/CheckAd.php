<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ad;
use Carbon\Carbon;

class CheckAd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkad:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check ad end date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       /* $dt = Carbon::now();
        $today = $dt->toDateString();
        $ads =Ad::where('status','approved')->whereDate('end_date','<=',"$today")->get();
        if(!empty($ads)){
            foreach($ads as $ad)
                $ad->update(['status'=>'expired']);
        }*/
        $ads =Ad::where('status','approved')->get();
        if(!empty($ads)){
            foreach($ads as $ad){
                if($ad->remaining >0){
                $ad->update(['remaining'=> ($ad->remaining)-1 ]);}
                else{
                $ad->update(['status'=>'Expired']);}
            }
        }
    }
}
