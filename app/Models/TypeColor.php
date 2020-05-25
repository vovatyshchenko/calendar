<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TypeColor extends Model
{
    public function getTypeColors()
    {
        return DB::table('type_colors')
            ->where('user_id','=', Auth::user()->id)
            ->get();
    }
}
