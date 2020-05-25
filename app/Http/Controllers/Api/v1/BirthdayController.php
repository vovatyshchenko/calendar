<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Birthday\StoreRequest;
use App\Http\Requests\Birthday\UpdateRequest;
use App\Models\Birthday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BirthdayController extends Controller
{
    public function store(StoreRequest $request)
    {
        $user_id=Auth::user()->id;
        $request['user_id']=$user_id;
        Birthday::create($request->all());
        return response(['message' => true], 200);
    }

    public function show($id)
    {

        $bithday = Birthday::where('id',$id)
            ->where('user_id',auth()->user()->id)
            ->first();
        if(!$bithday){

            return response( 'error',403);
        }

        return response()->json($bithday);
    }
    public function update(UpdateRequest $request)
    {

        $data = $request->only(['name','time_start','date','is_remind','is_remind_year']);
        Birthday::where('user_id',auth()->user()->id)->where('id',$request->only('id'))->update($data);

        return response(['message' => true], 200);

    }
    public function destroy($id)
    {
            Birthday::destroy($id);

            return response(['message' => true], 200);
    }
}
