<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Birthday extends Model
{
    protected $fillable = [
        'name','user_id','time_start','date','is_remind','is_remind_year'
    ];
}
