<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    function json_fix_cyr($json_str) {
        $cyr_chars = array (
            '\u0430' => 'а', '\u0410' => 'А',
            '\u0431' => 'б', '\u0411' => 'Б',
            '\u0432' => 'в', '\u0412' => 'В',
            '\u0433' => 'г', '\u0413' => 'Г',
            '\u0434' => 'д', '\u0414' => 'Д',
            '\u0435' => 'е', '\u0415' => 'Е',
            '\u0451' => 'ё', '\u0401' => 'Ё',
            '\u0436' => 'ж', '\u0416' => 'Ж',
            '\u0437' => 'з', '\u0417' => 'З',
            '\u0438' => 'и', '\u0418' => 'И',
            '\u0439' => 'й', '\u0419' => 'Й',
            '\u043a' => 'к', '\u041a' => 'К',
            '\u043b' => 'л', '\u041b' => 'Л',
            '\u043c' => 'м', '\u041c' => 'М',
            '\u043d' => 'н', '\u041d' => 'Н',
            '\u043e' => 'о', '\u041e' => 'О',
            '\u043f' => 'п', '\u041f' => 'П',
            '\u0440' => 'р', '\u0420' => 'Р',
            '\u0441' => 'с', '\u0421' => 'С',
            '\u0442' => 'т', '\u0422' => 'Т',
            '\u0443' => 'у', '\u0423' => 'У',
            '\u0444' => 'ф', '\u0424' => 'Ф',
            '\u0445' => 'х', '\u0425' => 'Х',
            '\u0446' => 'ц', '\u0426' => 'Ц',
            '\u0447' => 'ч', '\u0427' => 'Ч',
            '\u0448' => 'ш', '\u0428' => 'Ш',
            '\u0449' => 'щ', '\u0429' => 'Щ',
            '\u044a' => 'ъ', '\u042a' => 'Ъ',
            '\u044b' => 'ы', '\u042b' => 'Ы',
            '\u044c' => 'ь', '\u042c' => 'Ь',
            '\u044d' => 'э', '\u042d' => 'Э',
            '\u044e' => 'ю', '\u042e' => 'Ю',
            '\u044f' => 'я', '\u042f' => 'Я',
            '\u0456' => 'і', '\u0406' => 'І',
            '\u0457' => 'ї', '\u0407' => 'Ї',
            '\r' => '',
            '\n' => '<br />',
            '\t' => ''
        );
        foreach ($cyr_chars as $cyr_char_key => $cyr_char) {
            $json_str = str_replace($cyr_char_key, $cyr_char, $json_str);
        }
        return $json_str;
    }

    public function getHoliday()
    {
        $json_url = "http://kayaposoft.com/enrico/json/v1.0/?action=getPublicHolidaysForMonth&month=1&year=2020&country=ukr";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $json_url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $response = curl_exec($curl);

        $jsonString = json_encode($response, true);
        $data=json_decode($jsonString);

        echo print_r($this->json_fix_cyr($data));

        $status = curl_getinfo($curl);
        curl_close($curl);
    }
}
