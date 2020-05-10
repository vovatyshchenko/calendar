<?php



use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require_once('Holidays/index.php');
//Auth::routes();

Route::get('/auth/redirect','Auth\AuthController@authorizathion')->name('login');
Route::get('/auth/callback', 'Auth\AuthController@callback');
Route::view('/', 'index')->middleware('auth');

Route::post('/create-activity', ('Api\v1\ActivityController@store'));
Route::view('/{any}', 'index')->where('any', '.*');

//Route::middleware('auth')->post('/logout', 'Auth\LogoutController@logout');

