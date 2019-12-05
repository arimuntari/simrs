<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Diagnosis;
use App\Action;
use App\Medicine;
class AutoCompleteController extends Controller
{
    public function patient(Request $request){
	    $data = patient::where('name', 'LIKE', "%{$request->q}%")->orWhere('code', 'LIKE', "%{$request->q}%")->get();
	    return response()->json($data);
	}
	public function diagnosis(Request $request){
	    $data = diagnosis::where('name', 'LIKE', "%{$request->q}%")->get();
	    return response()->json($data);
	}
	public function action(Request $request){
	    $data = Action::where('name', 'LIKE', "%{$request->q}%")->get();
	    return response()->json($data);
	}
	public function medicine(Request $request){
	    $data = Medicine::where('name', 'LIKE', "%{$request->q}%")->get();
	    return response()->json($data);
	}
}
