<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $fillable = [
        'name','description','user_id','time_start','time_end','date_start','date_end','parent_id'
    ];
    public function getTasks($dateStart,$dateEnd)
    {
        return DB::table('tasks')
            ->where('date_start','<=',$dateEnd)
            ->where('date_end','>=',$dateStart)
            ->where('user_id','=',Auth::user()->id)
            ->get();
    }
    public function searchTask($data)
    {
        $result=[];
        foreach ($data['description'] as $value) {

            $search = DB::table('tasks')
                ->where(function($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('description', 'like', '%' . $value . '%');
                })
                ->where('user_id', '=', Auth::user()->id)
                ->where('date_start','<=',$data['date_end'])
                ->where('date_end','>=',$data['date_start'])
                ->get()
                ->toArray();
            if (count($search) != 0) {
                foreach ($search as $key=>$element)
                {
                    $search[$key]->type='task';
                }
                array_push($result,$search);
            }
        }
        return $result;
    }
}
