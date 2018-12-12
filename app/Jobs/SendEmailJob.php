<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Support\Facades\Mail;
//use App\Mail\SendMailable;
use App\User;
use App\schedule;
use Illuminate\Support\Facades\Hash;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Schedule $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $data = schedule::orderBy('send_at', 'asc')->first();
        $data = $this->user;
        if($data){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->name.'@gmail.com';
            $user->password = Hash::make('123456');
            $result = $user->save();
            if($result){
                $data->delete();
            }
        }
    }
}
