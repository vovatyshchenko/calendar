<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Holiday\IndexRequest;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{


    public function index(Request $request)
    {

   
       return (new Holiday())->getHolidaysForMonth($request->all());
    }
}
