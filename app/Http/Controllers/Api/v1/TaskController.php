<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Birthday;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(StoreRequest $request)
    {
        $user_id=Auth::user()->id;
        $request['user_id']=$user_id;
        $start  = new Carbon($request['date_start']);
        $end  = new Carbon($request['date_end']);
       $difference=$start->diffInDays($end);
       if($difference==0)
       {
         Task::create($request->all());
       }
       else {
           $events=[];
            $startDate=Task::create($request->all());
            for ($event=1;$event<=$difference;$event++)
            {
                $request['parent_id']=$startDate->id;
                $new_date = clone(new Carbon($request['date_start']))->addDays(1);
                $request['date_start']=new Carbon($new_date->format('Y-m-d'));
                array_push($events,$request->all());

            }
           Task::insert($events);
       }
        return response(['message' => true], 200);
    }
    public function destroy(Request $request)
    {
        $user_id=Auth::user()->id;

        Task::where('id', '=', $request->only('id'))
            ->where('user_id','=',$user_id)
            ->orWhere('parent_id','=',$request->only('parent_id'))
            ->where('user_id','=',$user_id)
            ->orWhere('id','=',$request->only('parent_id'))
            ->where('user_id','=',$user_id)
            ->orWhere('parent_id','=',$request->only('id'))
            ->where('user_id','=',$user_id)
            ->delete();

        return response(['message' => true], 200);

    }
}
