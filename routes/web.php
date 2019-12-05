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
		Route::post('store/diagnosis', 'ExaminationController@storeDiagnosis')->name('exam.store.diagnosis');
		Route::get('destroy/diagnois/{id}', 'ExaminationController@destroyDiagnosis')->name('exam.destroy.diagnosis');
		Route::post('store/action', 'ExaminationController@storeAction')->name('exam.store.action');
		Route::get('destroy/action/{id}', 'ExaminationController@destroyAction')->name('exam.destroy.action');
		Route::post('store/medicine', 'ExaminationController@storeMedicine')->name('exam.store.medicine');
		Route::get('destroy/medicine/{id}', 'ExaminationController@destroyMedicine')->name('exam.destroy.medicine');
		//Route::get('/create', 'SellingController@create')->name('register.create');
	});

	Route::prefix('autocomplete')->group(function () {
		Route::get('patient', 'AutoCompleteController@patient')->name('patient');
		Route::get('diagnosis', 'AutoCompleteController@diagnosis')->name('diagnosis');
		Route::get('action', 'AutoCompleteController@action')->name('action');
		Route::get('medicine', 'AutoCompleteController@medicine')->name('medicine');
	});
});