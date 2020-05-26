<?php

namespace App\Console\Commands;

use App\Mail\Message;
use App\Mail\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $date=Carbon::now()->format('Y-m-d');

        $reminders=DB::table('birthdays')
            ->join('users','users.id',"=",'birthdays.user_id')
            ->whereMonth('date','=',date('m', strtotime($date)))
            ->whereDay('date','=',date('d', strtotime($date)))
            ->where('is_remind','=',1)
            ->get(['birthdays.name','birthdays.date','birthdays.time_start','users.email as email']);

        $subject='Напоминание о дне рождения';

        foreach ($reminders as $key=>$reminder)
        {
            $reminders[$key]->type='birthday';
            Mail::to($reminder->email)
                ->send(new Reminder(['name' => $reminder->name,
                    'date' => explode(' ',$reminder->date)[0],
                    'type'=>$reminder->type
                ],
                    $subject));
        }
    }
}
