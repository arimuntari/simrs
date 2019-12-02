<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
class AutoCompleteController extends Controller
{
    public function patient(Request $request){
	    $cari = $request->q;
	    $data = patient::where('name', 'LIKE', "%{$request->q}%")->orWhere('code', 'LIKE', "%{$request->q}%")->get();
	    return response()->json($data);
	}
	public function diagnosis(Request $request){
	    $cari = $request->q;
	    $data = patient::where('name', 'LIKE', "%{$request->q}%");
	    return response()->json($data);
	}
}
