<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Birthday extends Model
{
    protected $fillable = [
        'name','user_id','time_start','date','is_remind','is_remind_year'
    ];
    public function getBirthdays($dateStart,$dateEnd)
    {

        $monthStart = date('m', strtotime($dateStart['date_start']));
        $monthEnd=date('m', strtotime($dateEnd['date_end']));
        $dayRange=[];
        $start = new Carbon($dateStart['date_start']);
        $end = new Carbon($dateEnd['date_end']);
        $difference = $start->diffInDays($end);

        for ($day = 0; $day <= $difference; $day++) {
            $date=date('d', strtotime($start . " +" . $day . " day"));
            array_push($dayRange, $date);
        }
        return  DB::table('birthdays')
            ->whereMonth('date','>=',$monthStart)
            ->whereMonth('date','<=',$monthEnd)
             ->whereIn(DB::raw('DAY(date)'),$dayRange)
            ->where('user_id','=',Auth::user()->id)
            ->get();

    }
    public function searchBirthday($data)
    {
        $result=[];
        $dayRange=[];
        $start = new Carbon($data['date_start']);
        $end = new Carbon($data['date_end']);
        $difference = $start->diffInDays($end);

        for ($day = 0; $day <= $difference; $day++) {
            $day=date('d', strtotime($start . " +" . $day . " day"));
            array_push($dayRange, $day);
        }
        $monthStart = date('m', strtotime($data['date_start']));
        $monthEnd=date('m', strtotime($data['date_end']));
        foreach ($data['description'] as $value) {

            $search = DB::table('birthdays')
                ->where('user_id', '=', Auth::user()->id)
                ->whereMonth('date','>=',$monthStart)
                ->whereMonth('date','<=',$monthEnd)
                ->whereIn(DB::raw('DAY(date)'),$dayRange)
                ->where('name', 'LIKE', '%' . $value . '%')
                ->get(['name','time_start','date as date_start'])
                ->toArray();
            if (count($search) != 0) {
                foreach ($search as $key=>$element)
                {
                   $search[$key]->type='birthday';
                }
                array_push($result,$search);
            }
        }
        return $result;
    }
}
