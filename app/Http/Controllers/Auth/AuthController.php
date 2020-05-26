<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TypeColor;
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
            'client_id' => env('CLIENT_ID'),
            'redirect_uri' =>  env('REDIRECT_URI'),
            'response_type' => 'code',

        ]);
        return redirect(env('AUTORIZATION_URL').$query);
    }
    public function logout(Request $request)
    {
        $access_token = Auth::user()->token;

        $this->guard()->logout();

        $request->session()->invalidate();

        $http = new Client;
        $response = $http->request('GET', config('client_auth.server_uri').'/api/client_logout', [
            'headers' => [
                'Authorization' => 'Bearer '.$access_token,
                'Accept' => 'application/json',
            ],
        ]);

        return redirect(config('client_auth.server_uri').'/api/client_logout');
    }
    protected function callback(Request $request)
    {

        //заюзать use GuzzleHttp\Client;
        $http = new Client;

        $response = $http->post(env('GET_TOKEN'), [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' =>env('CLIENT_ID'),
                'client_secret' =>env('CLIENT_SECRET') ,
                'redirect_uri' => env('REDIRECT_URI'),
                'code' => $request->code,
            ],
        ]);


        $access = json_decode((string) $response->getBody());

        if (isset($access->access_token) && $access->access_token) {

            $access_token = $access->access_token;

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

            $response = json_decode($result, true);
            $userData['email'] = $response['email'];
            $userData['surname'] = $response['surname'];
            $userData['name'] = $response['name'];
            $userData['token'] = $access->access_token;
            $user = User::where('email',$response['email'])->first();
            if($user){

                User::where('email',$response['email'])->update($userData);
                $user = User::where('email',$response['email'])->first();
                Auth::login($user);
            }
            else{
                $user = User::firstOrCreate(
                    [
                        'email' => $response['email'],
                        'token' => $access->access_token,
                        'surname' => $response['surname'],
                        'name' => $response['name'],
                    ]

                );
                Auth::login($user);
                TypeColor::create(
                    [
                        'user_id'=>Auth::user()->id,
                        'birthdays_active'=>true,
                        'tasks_active'=>true,
                        'activities_active'=>true,
                        'holidays_active'=>true,

                        'birthdays_color'=>0,
                        'tasks_color'=>0,
                        'activities_color'=>0,
                        'holidays_color'=>0
                    ]
                );
            }
            return response()->redirectTo(RouteServiceProvider::HOME);
        }
    }
    public function authByToken(Request $request)
    {

        $access_token = $request->access_token;

        if(empty($access_token)){
            return response()->redirectTo('/redirect');
        }
        // use above token to make further api calls in this session or until the access token expires
        $ch = curl_init();
        $url = env('GET_USER');
        $header = array(
            'Authorization: Bearer '. $access_token
        );


        curl_setopt($ch,CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);//данные о user
        $user = User::where('email',$response['email'])->first();
        $userData['email'] = $response['email'];
        $userData['surname'] = $response['surname'];
        $userData['name'] = $response['name'];
        $userData['token'] =$access_token;
        if($user){

            User::where('email',$response['email'])->update($userData);
            $user = User::where('email',$response['email'])->first();
            Auth::login($user);
        }
        else {
            $user = User::firstOrCreate(
                [
                    'email' => $response['email'],
                    'token' => $access_token,
                    'surname' => $response['surname'],
                    'name' => $response['name'],
                ]

            );
            Auth::login($user);
            TypeColor::create(
                [
                    'user_id'=>Auth::user()->id,
                    'birthdays_active'=>true,
                    'tasks_active'=>true,
                    'activities_active'=>true,
                    'holidays_active'=>true,

                    'birthdays_color'=>0,
                    'tasks_color'=>0,
                    'activities_color'=>0,
                    'holidays_color'=>0
                ]
            );
        }

        return response()->redirectTo(RouteServiceProvider::HOME);
    }
}

