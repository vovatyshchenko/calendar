<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Birthday;
use App\Models\Event;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    public function getEvents(Request $request)
    {
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
        $events=$this->dataFormattingEvent(collect($activities)->groupBy('date_start'),$events);
        $events=$this->dataFormattingEvent(collect($tasks)->groupBy('date_start'),$events);
        $events= $this->rangeEventDays($events);
        $events=$this->dataFormattingEvent(collect($birthdays)->groupBy('date'),$events);

        $sortedEvents=$this->sortedEvent($events);

        return $sortedEvents;
    }

    public function dataFormattingEvent($event,$events)
    {
        foreach($event as $key=>$element)
        {
            $key=explode(' ',$key)[0];
            foreach ($element as $el)
            {
                $events[$key]?? $events[$key]=[];

                array_push($events[$key],$el);
            }
        }
        return  $events;
    }
    public function sortedEvent($events)
    {

        foreach ($events as $key=>$event)
        {
            $events[$key]=collect($event)->sortBy('time_start')->values();
        }
        return collect($events);
    }
    public function rangeEventDays($events)
    {

        foreach ($events as $key=>$event)
        {
            foreach ($event as $elementKey=>$element )
            {

                $start  = new Carbon($element->date_start);
                $end  = new Carbon($element->date_end);
                $difference=$start->diffInDays($end);

                for ($day=1;$day<=$difference;$day++)
                {
                    $date=date('Y-m-d', strtotime($element->date_start. " +". $day." day"));

                    $events[$date]?? $events[$date]=[];

                    array_push( $events[$date],$event[$elementKey]);
                }
            }

        }

        return $events;
    }
}

