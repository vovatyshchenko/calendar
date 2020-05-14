<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Birthday\StoreRequest;
use App\Models\Birthday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BirthdayController extends Controller
{
    public function store(StoreRequest $request)
    {
        //$user_id=Auth::user()->id;
        $request['user_id']=10;
        Birthday::create($request->all());
        return response(['message' => true], 200);
    }
    public function destroy($id)
    {
            Birthday::destroy($id);
            return response(['message' => true], 200);;
    }
}
