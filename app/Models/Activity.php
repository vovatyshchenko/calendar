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
    public function searchActivity($data)
    {
        $result=[];
        foreach ($data['description'] as $value) {

            $search = DB::table('activities')
                ->where(function($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('description', 'like', '%' . $value . '%');
                })
                ->where('user_id', '=', Auth::user()->id)
                ->where('date_start', '>=', $data['date_start'])
                ->where('date_end', '<=', $data['date_end'])
                ->get()
                ->toArray();
            if (count($search) != 0) {
                foreach ($search as $key=>$element)
                {
                    $search[$key]->type='activity';
                }
                array_push($result,$search);
            }
        }
        return $result;
    }
}
