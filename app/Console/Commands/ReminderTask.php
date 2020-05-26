<?php

namespace App\Console\Commands;

use App\Mail\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:task';

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
//        $date=Carbon::now()->format('Y-m-d');
        $date='2020-05-26';
        $reminders=DB::table('tasks')
            ->join('users','users.id',"=",'tasks.user_id')
            ->where('tasks.date_start','<=',$date)
            ->where('tasks.date_end','>=',$date)
            ->where('tasks.is_remind','=',1)
            ->get(['tasks.name','tasks.description','tasks.time_start','tasks.time_end','tasks.date_start','tasks.date_end','users.email as email']);

        $subject='Напоминание о задаче';

        foreach ($reminders as $key=>$reminder)
        {
            $reminders[$key]->type='tasks';
            Mail::to($reminder->email)
                ->send(new Reminder(['name' => $reminder->name,
                    'date_start' => explode(' ',$reminder->date_start)[0],
                    'date_end' => explode(' ',$reminder->date_end)[0],
                    'description' =>  $reminder->description,
                    'time_start'=>$reminder->time_start,
                    'time_end'=>$reminder->time_end,
                    'type'=>$reminder->type
                ],
                    $subject));
        }
    }
}
