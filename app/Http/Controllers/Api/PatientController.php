<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
class PatientController extends Controller
{

    function get(Request $request){
        $id = $request->patient_id;
        $patient = Patient::find($id);
        if($patient){
            $response["errCode"] = "";
            $response["errMessage"] = "";
            $response["data"] =  array(
                     'id' => $patient->id,
                     'code' => $patient->code, 
                     'name' => $patient->name, 
                     'birthdate' => $patient->birthdate, 
                     'phone_number' => $patient->phone_number,
                     'address' =>  $patient->address);
            
        }else{
            $response["errCode"] = "404";
            $response["errMessage"] = "Update gagal data tidak ditemukan!!";
        }
        
        return json_encode($response);
    }

    function update(Request $request){
    	$id = $request->id;
    	$patient = Patient::find($id);
        if($patient->update($request->all())){
            $response["errCode"] = "";
    		$response["errMessage"] = "";
    		$response["data"] =  array(
                     'id' => $patient->id,
                     'code' => $patient->code, 
                     'name' => $patient->name, 
                     'birthdate' => $patient->birthdate, 
    				 'phone_number' => $patient->phone_number,
    				 'address' =>  $patient->address);
    		
    	}else{
    		$response["errCode"] = "404";
			$response["errMessage"] = "Update gagal data tidak ditemukan!!";
    	}
    	
    	return json_encode($response);
    }
}
