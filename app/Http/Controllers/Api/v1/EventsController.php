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
        $tasks = $event->getTasks('2020-05-12','2020-05-19');
        foreach($tasks as $key=>$task)
        {
            $tasks[$key]->type='task';
        }
        $activities = $event->getActivities('2020-05-12','2020-05-19');
        foreach($activities as $key=>$activity)
        {
            $activities[$key]->type='activity';
        }
        $birthdays = $event->getBirthdays('2020-05-12','2020-05-19');
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
