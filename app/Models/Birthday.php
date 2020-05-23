<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Birthday extends Model
{
    protected $fillable = [
        'name','user_id','time_start','date','is_remind','is_remind_year'
    ];
    public function getBirthdays($dateStart,$dateEnd)
    {
        return DB::table('birthdays')
            ->where('date','>=',$dateStart)
            ->where('date','<=',$dateEnd)
            ->where('user_id','=',Auth::user()->id)
            ->get();
    }
    public function searchBirthday($data)
    {
        $result=[];
        foreach ($data['description'] as $value) {

            $search = DB::table('birthdays')
                ->where('user_id', '=', Auth::user()->id)
                ->where('date', '>=', $data['date_start'])
                ->where('date', '<=', $data['date_end'])
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
