<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\StoreRequest;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function cleaningStr(string $data): string
    {
        return strip_tags(trim($data));
    }
    public function store(StoreRequest $request)
    {
        //$user_id=Auth::user()->id;
        $request['user_id']=10;
        $result= Activity::create($request->all());
        return response(['message' => true], 200);
    }
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return ['response'=>'deleted'];
    }
}
