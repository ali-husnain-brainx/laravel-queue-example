<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use App\schedule;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {    
        //$start  = Carbon::now();
        $end    = new Carbon('2018-12-12 14:04:00');
        //$time = $start->diffInMinutes($end);
        //return $time;
        $schedule = new schedule();
        $schedule->name = $request->name;
        $schedule->send_at = $end;
        $schedule->save();
        
        // $time= 1;
        //$delay = Carbon::now()->addMinutes($time);
        $emailJob = (new SendEmailJob($schedule))->delay($end);
        dispatch($emailJob);

        echo 'User scheduled! <br>';
    }
}