<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name','description','user_id','time_start','time_end','date_start','date_end','is_remind'
    ];

}
