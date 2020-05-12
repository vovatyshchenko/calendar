<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Birthday extends Model
{
    protected $fillable = [
        'name', 'description', 'user_id','time','date','allDay','allYear'
    ];
}
