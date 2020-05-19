<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    protected $fillable = [
        'name', 'guests', 'location','description','user_id','time_start','time_end','date_start','date_end','parent_id'
    ];
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function getActivities($dateStart,$dateEnd)
    {
        return DB::table('activities')
            ->where('date_start','>=',$dateStart)
            ->where('user_id','=',Auth::user()->id)
            ->get();
    }
}
