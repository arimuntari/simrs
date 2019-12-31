<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Register;
use App\Patient;
use App\CheckupDiagnosis;
use App\CheckupAction;
use App\CheckupMedicine;
use App\Medicine;

class ExamController extends Controller
{
    function index(Request $request){
    	$patientId = $request->patient_id;
 		$registers = Register::where('patient_id', $patientId)->where('status', '1')->orderBy("date_register", "desc")->get();
 		 if(count($registers) > 0){
            $response["errCode"] = "";
    		$response["errMessage"] = "";
    		$response["data"] = $registers;
    		
    	}else{
    		$response["errCode"] = "404";
			$response["errMessage"] = "data tidak ditemukan!!";
    	}
    	return json_encode($response);
    }
    function total(Request $request){
        $patientId = $request->patient_id;
        $registers = Register::where('patient_id', $patientId)->where('status', '1')->get()->sum("price_total");
         if($registers > 0){
            $response["errCode"] = "";
            $response["errMessage"] = "";
            $response["data"] = 'Rp. ' . number_format($registers, 0, '.', '.');
            
        }else{
            $response["errCode"] = "404";
            $response["errMessage"] = "data tidak ditemukan!!";
        }
        return json_encode($response);
    }
}
