<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function authorizathion()
    {
        $query = http_build_query([
            'client_id' => env('CLIENT_ID'),//запросить у Богдана и вынести в конфиг
            'redirect_uri' =>  env('REDIRECT_URL'),//урл куда оправит сайт Богдана после успешной
            'response_type' => 'code',
   
        ]);
        return redirect(env('AUTORIZATION_URL').$query);
    }

    protected function callback(Request $request)
    {
        //заюзать use GuzzleHttp\Client;
        $http = new Client;

        $response = $http->post(env('GET_TOKEN'), [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' =>env('CLIENT_ID'), //данные которые выдаст Богдан. вынести в конфиг
                'client_secret' =>env('CLIENT_SECRET') ,//данные которые выдаст Богдан. вынести в конфиг
                'redirect_uri' => env('REDIRECT_URL'),
                'code' => $request->code,
            ],
        ]);


        $access = json_decode((string) $response->getBody());//данные с токеном. придет сам токен и время его жизни

        if (isset($access->access_token) && $access->access_token) {
            // you would like to store the access_token in the session though...
            $access_token = $access->access_token;

            // получение данных пользователя
            $ch = curl_init();
            $url = env('GET_USER');
            $header = array(
                'Authorization: Bearer ' . $access_token
            );


            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $result = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($result, true);//данные о user пришедшие от Богдана

//нужно сохранить пользователя на вашем преокте, если уже есть пользователь с таким email тогда обновить токен

            $user = User::firstOrCreate(
                ['email' => $response['email']],
                ['name'=> $response['name'],
                    'password' => Hash::make('gfhjkm'), 'token' => $access->access_token]

            );

//авторизовать пользователя
            $Rres = Auth::login($user);

//перекинуть в личны кабинет
            return response()->redirectTo(RouteServiceProvider::HOME);
        }
    }

}

    /*
    team1-group-project.azurewebsites.net - урл Богдана, его тоже вынести в конфиг
    */
