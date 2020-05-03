<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
   protected  function logout()
   {
       Auth::logout();
       return response()->redirectTo(RouteServiceProvider::HOME);
   }
}
