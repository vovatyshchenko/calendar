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

    public function getYearHolidays()
    {
        $json_url = "https://kayaposoft.com/enrico/json/v2.0/?action=getHolidaysForYear&year=2020&country=ukr&holidayType=public_holiday";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $json_url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $response = curl_exec($curl);

        $jsonString = json_encode($response, true);
        $data=json_decode($jsonString);

        $status = curl_getinfo($curl);
        curl_close($curl);

        return((new Holiday())->jsonEncode($data));
    }
}
