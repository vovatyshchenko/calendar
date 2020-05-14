<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Event extends Model
{
     public function getActivities($dateStart,$dateEnd)
     {
         return DB::table('activities')
             ->where('date_start','>=',$dateStart)
             ->where('user_id','=','10')
             ->where('date_end','<=',$dateEnd)
             ->orderBy('time_start')
             ->get();
     }
    public function getTasks($dateStart,$dateEnd)
    {
        return DB::table('tasks')
            ->where('date_start','>=',$dateStart)
            ->where('user_id','=','10')
            ->where('date_end','<=',$dateEnd)
            ->orderBy('time_start')
            ->get();
    }
    public function getBirthdays($dateStart,$dateEnd)
    {
        return DB::table('birthdays')
            ->where('date','>=',$dateStart)
            ->where('date','<=',$dateEnd)
            ->where('user_id','=','10')
            ->get();
    }
}
