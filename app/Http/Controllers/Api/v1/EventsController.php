<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function getEvents(Request $request)
    {
        $event=new Event();
        $tasks = $event->getTasks($request->only('date_start'),$request->only('date_end'));
        foreach($tasks as $key=>$task)
        {
            $tasks[$key]->type='task';
        }
        $activities = $event->getActivities($request->only('date_start'),$request->only('date_end'));
        foreach($activities as $key=>$activity)
        {
            $activities[$key]->type='activity';
        }
        $birthdays = $event->getBirthdays($request->only('date_start'),$request->only('date_end'));
        foreach($birthdays as $key=>$birthday)
        {
            $birthdays[$key]->type='birthday';
        }

        $events=['activities'=>collect($activities)->groupBy('date_start'),
            'tasks'=>collect($tasks)->groupBy('date_start'),
            'birthdays'=>collect($birthdays)->groupBy('date')
        ];

        return $events;
    }
}
