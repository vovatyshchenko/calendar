<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Event extends Model
{

    public function clear($data)
    {
        return preg_split('/\s+/', preg_replace("/ {2,}/", " ", trim(mb_eregi_replace("[^a-zа-яё0-9 ]", '', strip_tags($data['description'])))));
    }

    public function dataFormattingEvent($event, $events)
    {

        foreach ($event as $key => $element) {
            $key = explode(' ', $key)[0];
            $parseKeyDate=explode('-',$key);
            foreach ($element as $elementData) {
                $events[$parseKeyDate[1].'-'.$parseKeyDate[2]] ?? $events[$parseKeyDate[1].'-'.$parseKeyDate[2]] = [];
                array_push($events[$parseKeyDate[1].'-'.$parseKeyDate[2]], $elementData);
            }
        }
        return $events;
    }

    public function sortedEvent($events)
    {

        foreach ($events as $key => $event) {
            $events[$key] = collect($event)->sortBy('time_start')->values();
        }
        return collect($events);
    }

    public function rangeEventDays($events)
    {

        foreach ($events as $key => $event) {
            foreach ($event as $elementKey => $element) {
                $start = new Carbon($element->date_start);
                $end = new Carbon($element->date_end);
                $difference = $start->diffInDays($end);

                for ($day = 1; $day <= $difference; $day++) {
                    $date = date('Y-m-d', strtotime($element->date_start . " +" . $day . " day"));
                    $dateParse=explode('-',$date);
                    $events[$dateParse[1].'-'.$dateParse[2]] ?? $events[$dateParse[1].'-'.$dateParse[2]] = [];

                    array_push($events[$dateParse[1].'-'.$dateParse[2]], $event[$elementKey]);
                }
            }

        }

        return $events;
    }

    public function searchEvents($events)
    {

        $resultSeacrh = [];

        foreach ($events['search_area'] as $valueEvent) {
            switch ($valueEvent) {
                case 'Дни рождения':
                    array_push($resultSeacrh, (new Birthday())->searchBirthday($events));
                    break;
                case 'Задачи':
                    array_push($resultSeacrh, (new Task())->searchTask($events));
                    break;
                case 'Мероприятия':
                    array_push($resultSeacrh, (new Activity())->searchActivity($events));
                    break;
                case 'Напоминания':
                    break;
                case 'Праздники Украины':
                    array_push($resultSeacrh, (new Holiday())->searchHoliday($events));
                    break;
            }

        }

        $flattened = collect($resultSeacrh)->flatten();
        $sorted = $flattened->sortBy('time_start')->sortBy('date_start')->values()->all();

        return $sorted;
    }

}

