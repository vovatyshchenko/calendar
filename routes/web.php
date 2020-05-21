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
//
Route::get('/auth/redirect','Auth\AuthController@authorizathion')->name('login');
Route::get('/auth/callback', 'Auth\AuthController@callback');

Route::view('/', 'index')->middleware('auth');
Route::post('/events', ('Api\v1\EventsController@getEvents'));
Route::post('/create-activity', ('Api\v1\ActivityController@store'));
Route::post('/create-task', ('Api\v1\TaskController@store'));
Route::post('/create-birthday', ('Api\v1\BirthdayController@store'));

Route::delete('/delete-activity', ('Api\v1\ActivityController@destroy'));
Route::delete('/delete-task', ('Api\v1\TaskController@destroy'));
Route::delete('/delete-birthday/{id}', ('Api\v1\BirthdayController@destroy'));
Route::get('/birthday/{id}', ('Api\v1\BirthdayController@show'));
Route::get('/activity/{id}', ('Api\v1\ActivityController@show'));
Route::get('/task/{id}', ('Api\v1\TaskController@show'));
Route::put('/update-birthday', ('Api\v1\BirthdayController@update'));
Route::put('/update-activity', ('Api\v1\ActivityController@update'));
Route::put('/update-task', ('Api\v1\TaskController@update'));
Route::post('/search', ('Api\v1\EventsController@search'));

Route::view('/{any}', 'index')->where('any', '.*');
Route::middleware('auth')->get('/logout', 'Auth\LogoutController@logout');

