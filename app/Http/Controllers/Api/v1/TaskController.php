<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
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
        Task::create($request->all());

        return response(['message' => true], 200);
    }
    public function show($id)
    {

        $task = Task::where('id',$id)
            ->where('user_id',auth()->user()->id)
            ->first();
        if(!$task){

            return response( 'error',403);
        }

        return response()->json($task);
    }
    public function destroy(Request $request)
    {
        $user_id=Auth::user()->id;

        Task::where('id', '=', $request->only('id'))
            ->where('user_id','=',$user_id)
            ->delete();

        return response(['message' => true], 200);
    }
    public function update( UpdateRequest $request)
    {

        $data = $request->only(['name','is_remind','description','time_start','time_end','date_start','date_end']);
        Task::where('user_id',auth()->user()->id)->where('id',$request->only('id'))->update($data);

        return response(['message' => true], 200);

    }
}
