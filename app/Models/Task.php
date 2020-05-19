<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $fillable = [

        'name','description','user_id','time_start','time_end','date_start','date_end','parent_id','is_remind'
    ];
    public function getTasks($dateStart,$dateEnd)
    {
        return DB::table('tasks')
            ->where('date_start','>=',$dateStart)
            ->where('user_id','=',/*Auth::user()->id*/10)
            ->where('date_end','<=',$dateEnd)
            ->get();
    }
}
