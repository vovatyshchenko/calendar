<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;
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
    public function destroy(Task $task)
    {
        $task->delete();

        return ['response'=>'deleted'];
    }
}
