<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'LoginController@login')->name('proses_login');


Route::middleware(['checklogin'])->group(function () {
	Route::get('/logout', 'LoginController@logout')->name('logout');
	Route::get('/index', function () {
	    	return view('admin/index', ['title' => "Dashboard"]);
	});

    Route::resources([
	    'users' => 'UsersController',
	    'medicine' => 'MedicineController',
	    'diagnosis' => 'DiagnosisController',
	    'action' => 'ActionController',
	    'patient' => 'PatientController',
	]);
});