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


Route::get('/auth/redirect','Auth\AuthController@authorizathion')->name('login');
Route::get('/auth/callback', 'Auth\AuthController@callback');

Route::view('/', 'index')->middleware('auth');
Route::post('/events', ('Api\v1\EventsController@getEvents'))->middleware('auth');
Route::post('/create-activity', ('Api\v1\ActivityController@store'))->middleware('auth');
Route::post('/create-task', ('Api\v1\TaskController@store'))->middleware('auth');
Route::post('/create-birthday', ('Api\v1\BirthdayController@store'))->middleware('auth');

Route::delete('/delete-activity', ('Api\v1\ActivityController@destroy'))->middleware('auth');
Route::delete('/delete-task', ('Api\v1\TaskController@destroy'))->middleware('auth');
Route::delete('/delete-birthday/{id}', ('Api\v1\BirthdayController@destroy'))->middleware('auth');
Route::get('/birthday/{id}', ('Api\v1\BirthdayController@show'))->middleware('auth');
Route::get('/activity/{id}', ('Api\v1\ActivityController@show'))->middleware('auth');
Route::get('/task/{id}', ('Api\v1\TaskController@show'))->middleware('auth');
Route::put('/update-birthday', ('Api\v1\BirthdayController@update'))->middleware('auth');
Route::put('/update-activity', ('Api\v1\ActivityController@update'))->middleware('auth');
Route::put('/update-task', ('Api\v1\TaskController@update'))->middleware('auth');
Route::post('/search', ('Api\v1\EventsController@search'))->middleware('auth');
Route::get('/token', 'Auth\AuthController@authByToken')->middleware('auth');

Route::get('/user/getInfo', ('Api\v1\UserController@getParam'))->middleware('auth');

Route::get('/type-colors', ('Api\v1\TypeColorsController@show'))->middleware('auth');
Route::put('/update-type-colors', ('Api\v1\TypeColorsController@update'))->middleware('auth');

Route::view('/{any}', 'index')->where('any', '.*')->middleware('auth');
Route::middleware('auth')->post('/logout', 'Auth\LogoutController@logout');

