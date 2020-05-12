<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'guests', 'location','description','user_id','time_start','time_end','date_start','date_end'
    ];
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function getActivities()
    {

        return Activity::where('user_id','10')->get();
    }
}
