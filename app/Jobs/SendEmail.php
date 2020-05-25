<?php

namespace App\Jobs;

use App\Mail\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $activity=[];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($activity)
    {
        $this->activity=$activity;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $subject='Напоминание о мероприятии';
        foreach (explode(';',$this->activity->guests) as $email)
        {
            if($email)
            {
                Mail::to($email)
                    ->send(new Message(['name'=>$this->activity->name,
                        'location'=>$this->activity->location,
                        'description'=>$this->activity->description,
                        'time_start'=>$this->activity->time_start,
                        'time_end'=>$this->activity->time_end,
                        'date_start'=> explode(' ',$this->activity->date_start)[0],
                        'date_end'=>explode(' ',$this->activity->date_end)[0],
                        ],
                        $subject));
            }

        }

    }
}
