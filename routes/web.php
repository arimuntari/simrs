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

	Route::prefix('register')->group(function () {
		Route::get('/', 'RegisterController@index')->name('register.index');
		Route::post('store/', 'RegisterController@store')->name('register.store');
		Route::get('destroy/{id}', 'RegisterController@destroy')->name('register.destroy');
		//Route::get('/create', 'SellingController@create')->name('register.create');
	});


	Route::prefix('exam')->group(function () {
		Route::get('/', 'ExaminationController@index')->name('exam.index');
		Route::get('/{register_id}', 'ExaminationController@index')->name('exam.view');
		Route::get('destroy/{$id}', 'ExaminationController@destroyDiagnosa')->name('exam.destroyDiagnosa');
		//Route::get('/create', 'SellingController@create')->name('register.create');
	});

	Route::prefix('autocomplete')->group(function () {
		Route::get('patient', 'AutoCompleteController@patient')->name('patient');
		Route::get('customer', 'AutoCompleteController@customer')->name('customer');
		Route::get('supplier', 'AutoCompleteController@supplier')->name('supplier');
	});
});