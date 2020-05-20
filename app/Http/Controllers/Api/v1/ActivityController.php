<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\StoreRequest;
use App\Http\Requests\Activity\UpdateRequest;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function cleaningStr(string $data): string
    {
        return strip_tags(trim($data));
    }

    public function store(StoreRequest $request)
    {
        $user_id = Auth::user()->id;
        $request['user_id'] = $user_id;
        Activity::create($request->all());
        return response(['message' => true], 200);
    }

    public function show($id)
    {
        $activity = Activity::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (!$activity) {

            return response('error', 403);
        }

        return response()->json($activity);
    }
    public function update(UpdateRequest $request)
    {

        $data = $request->only(['name','guests','location','description','time_start','time_end','date_start','date_end']);
        Activity::where('user_id',auth()->user()->id)->where('id',$request->only('id'))->update($data);

        return response(['message' => true], 200);

    }
    public function destroy(Request $request)
    {
        $user_id = Auth::user()->id;
        Activity::where('id', '=', $request->only('id'))
            ->where('user_id', '=', $user_id)
            ->delete();
        return response(['message' => true], 200);

    }
}
