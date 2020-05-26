<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TypeColor extends Model
{
    protected $fillable = [
        'user_id','birthdays_active', 'tasks_active', 'activities_active', 'holidays_active', 'birthdays_color', 'tasks_color', 'activities_color', 'holidays_color'
    ];
    public function getTypeColors()
    {
        return DB::table('type_colors')
            ->where('user_id','=', Auth::user()->id)
            ->get();
    }
}
