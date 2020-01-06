<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Register;
use Helper;
use Carbon\carbon;

class RegisterController extends Controller
{
	function register(Request $request){

		$patient_id = $request->patient_id;
        $patient= Patient::where("id", $patient_id)->first();

        $patient_id = $patient->id;

        $register= Register::whereDate("date_register", Carbon::today()->toDateString())->first();
        if(!$register){
	        $register = new Register;
	        $register->no_register = Helper::noRegister();
	        $register->patient_id = $patient_id; 
	        $register->date_register = Carbon::now();
	        $register->time = Carbon::now();

	        if($register->save()){  
	            $response["errCode"] = "";
	    		$response["errMessage"] = "";
	    		$response["data"] =  array(
	                     'id' => $register->id,
	                     'no_register' => $register->no_register, 
	                     'date_register' => $register->date_register, 
	    				 'time' => $register->time);
	        }else{
	        	$response["errCode"] = "500";
				$response["errMessage"] = "Pendaftaran gagal data tidak ditemukan!!";
	        }
        }else{
        	$response["errCode"] = "2001";
			$response["errMessage"] = "Anda sudah daftar hari ini!!";
        }

    	return json_encode($response);
	}
	function queue(){
		$register= Register::whereDate("date_register", Carbon::today()->toDateString())->where('status', '1')->orderBy("date_register", "desc")->first();
		if($register){
			 $response["errCode"] = "";
    		$response["errMessage"] = "";
    		$response["data"] =  $register->no_register;
		}else{
			$response["errCode"] = "";
    		$response["errMessage"] = "";
    		$response["data"] =  0;
		}

    	return json_encode($response);
	}
	function myQueue(Request $request){
		$patient_id = $request->patient_id;
		$register= Register::whereDate("date_register", Carbon::today()->toDateString())
					->where('status', '0')
					->where('patient_id', $patient_id)->first();
		if($register){
			$response["errCode"] = "";
    		$response["errMessage"] = "";
    		$response["data"] =  $register->no_register;
		}else{
			$response["errCode"] = "2001";
    		$response["errMessage"] = "Anda belum mendaftar!!";
		}
    	return json_encode($response);
	}
}
