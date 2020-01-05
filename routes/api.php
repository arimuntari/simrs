<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\LoginController@login');
Route::post('patient', 'Api\PatientController@get');
Route::post('patient/update', 'Api\PatientController@update');
Route::post('register', 'Api\RegisterController@register');
Route::post('register/queue', 'Api\RegisterController@queue');
Route::post('register/myqueue', 'Api\RegisterController@myQueue');
Route::post('exam/view', 'Api\ExamController@index');
Route::post('exam/total', 'Api\ExamController@total');
Route::post('exam/detail', 'Api\ExamController@detail');