<?php

/*Route::prefix('user')->group(function () {
    Route::post('/login', 'api\v1\auth\AuthController@login');
    Route::post('/register', 'api\v1\auth\AuthController@register');
    Route::middleware('auth:api')->get('/getuser', 'api\v1\user\UserController@getCurrentUser');
});*/
Route::get('/get-holidays', 'api\v1\HolidayController@getHolidays');
Route::get('/get-year-holidays', 'api\v1\HolidayController@getYearHolidays');

