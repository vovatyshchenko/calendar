<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\StoreRequest;
use App\Http\Requests\Activity\UpdateRequest;
use App\Jobs\SendEmail;
use App\Mail\Message;
use App\Mail\Reminder;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ActivityController extends Controller
{
    public function cleaningStr(string $data): string
    {
        return strip_tags(trim($data));
    }
    public function test()
    {
        $date=Carbon::now()->format('Y-m-d');

        $reminders=DB::table('tasks')
            ->join('users','users.id',"=",'tasks.user_id')
            ->where('tasks.date_start','<=','2020-05-26')
            ->where('tasks.date_end','>=','2020-05-26')
            ->where('tasks.is_remind','=',1)
            ->get(['tasks.name','tasks.description','tasks.time_start','tasks.time_end','tasks.date_start','tasks.date_end','users.email as email']);

        dd($reminders);
//        $subject='Напоминание о дне рождения';
//
//        foreach ($reminders as $key=>$reminder)
//        {
//            $reminders[$key]->type='birthday';
//            Mail::to($reminder->email)
//                ->send(new Reminder(['name' => $reminder->name,
//                    'date' => explode(' ',$reminder->date)[0],
//                    'type'=>$reminder->type
//                ],
//                    $subject));
//        }

    }
    public function store(StoreRequest $request)
    {
        $emails=$request->only('guests');


        if(!(new Activity())->isValidEmail($emails))
        {
            return response(['message' => 'Введенный email некорректно введён'], 422);
        }

        $user_id = Auth::user()->id;
        $request['user_id'] = $user_id;
        $activity=Activity::create($request->all());

       SendEmail::dispatch($activity);

        return response(['message' => true], 200);

    }

    public function show($id)
    {
        $activity = Activity::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (!$activity) {

            return response(['message' => 'Пользователя нет'], 422);
        }

        return response()->json($activity);
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->only(['name','guests','location','description','time_start','time_end','date_start','date_end']);
        $emails=$request->only('guests');

        if(!(new Activity())->isValidEmail($emails))
        {
            return response(['message' => 'Введенный email некорректно введён'], 422);
        }
        Activity::where('user_id',auth()->user()->id)->where('id',$request->only('id'))->update($data);
        $activity= Activity::where('user_id',auth()->user()->id)->where('id',$request->only('id'))->first();

        SendEmail::dispatch($activity);

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
