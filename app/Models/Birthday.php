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
}
