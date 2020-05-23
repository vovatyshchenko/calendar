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

            $user = User::where('email',$response['email'])->first();
            if($user){
                $user->update([
                    'email' => $user->email,
                    'name' => $user->name,
                    'password' => $user->password,
                    'token' => $access_token
                ]);

                Auth::login($user);
            }
            else {
                $user = User::firstOrCreate([
                        'email' => $response['email'],
                        'name' => $response['name'],
                        'password' => Hash::make('gfhjkm'),
                        'token' => $access_token
                    ]
                );

                Auth::login($user);
            }

            return response()->redirectTo(RouteServiceProvider::HOME);
        }
    }

}

