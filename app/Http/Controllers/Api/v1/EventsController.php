<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use App\Models\Activity;
use App\Models\Birthday;
use App\Models\Event;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function getEvents(Request $request)
    {
        $workWithEvents=new Event();
        $tasks =(new Task())->getTasks($request->only('date_start'),$request->only('date_end'));
        foreach($tasks as $key=>$task)
        {
            $tasks[$key]->type='task';
        }
        $activities = (new Activity())->getActivities($request->only('date_start'),$request->only('date_end'));
        foreach($activities as $key=>$activity)
        {
            $activities[$key]->type='activity';
        }
        $birthdays = (new Birthday())->getBirthdays($request->only('date_start'),$request->only('date_end'));
        foreach($birthdays as $key=>$birthday)
        {
            $birthdays[$key]->type='birthday';
        }
        $events=[];
        $events=$workWithEvents->dataFormattingEvent(collect($activities)->groupBy('date_start'),$events);
        $events=$workWithEvents->dataFormattingEvent(collect($tasks)->groupBy('date_start'),$events);
        $events= $workWithEvents->rangeEventDays($events);
        $events=$workWithEvents->dataFormattingEvent(collect($birthdays)->groupBy('date'),$events);

        $sortedEvents=$workWithEvents->sortedEvent($events);

        return response()->json($sortedEvents, 200);
    }
    public function search(SearchRequest $request)
    {

        $events=$request->only(['search_area','date_start','date_end']);
        $events['description']=(new Event())->clear($request->only(['description']));

       return response()->json( (new Event())->searchEvents($events), 200);

    }

}

