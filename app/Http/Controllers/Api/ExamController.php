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
use Helper;

class ExamController extends Controller
{
    function index(Request $request){
    	$patientId = $request->patient_id;
 		$registers = Register::where('patient_id', $patientId)->where('status', '1')->orderBy("date_register", "desc")->get();
 	    if(count($registers) > 0){
            $response["errCode"] = "";
    		$response["errMessage"] = "";
            foreach($registers as $register){
                $array = array(); 
                $array["id"] = $register->id;
                $array["noRegister"] = $register->no_register;
                $array["dateRegister"] = Helper::toIndo($register->date_register);
                $array["time"] = $register->time;
                $array["priceTotal"] = number_format($register->price_total, 0, '.', '.');

                $response["data"][] = $array;
            }    		
    	}else{
    		$response["errCode"] = "404";
			$response["errMessage"] = "data tidak ditemukan!!";
    	}
    	return json_encode($response);
    }
    function detail(Request $request){
        $id = $request->id;
        $register = Register::find($id);
        if($register){
                $response["errCode"] = "";
                $response["errMessage"] = "";
                $data = array(); 
                $data["id"] = $register->id;
                $data["noRegister"] = $register->no_register;
                $data["dateRegister"] = Helper::toIndo($register->date_register);
                $data["time"] = $register->time;
                $data["priceTotal"] = number_format($register->price_total, 0, '.', '.');
                $CheckupDiagnosis = CheckupDiagnosis::where("register_id", $id)->get();
                $data["diagnosis"] = array();
                if(count($CheckupDiagnosis) > 0){
                    foreach($CheckupDiagnosis as $CheckupDiagnosa){
                        $dataDiagnosis = array();
                        $dataDiagnosis["name"] = $CheckupDiagnosa->diagnosis->name; 
                        $data["diagnosis"][] = $dataDiagnosis;
                    }
                }
                $data["action"] = array();
                $checkupActions = CheckupAction::where("register_id", $id)->get();
                if(count($checkupActions) > 0){
                    foreach($checkupActions as $CheckupAction){
                        $dataAction = array();
                        $dataAction["name"] = $CheckupAction->action->name; 
                        $dataAction["price"] = 'Rp. ' . number_format($CheckupAction->price, 0, '.', '.');; 
                        $data["action"][] = $dataAction;
                    }
                }
                $data["medicine"] = array();
                $checkupMedicines = CheckupMedicine::where("register_id", $id)->get();
                if(count($checkupMedicines) > 0){
                    foreach($checkupMedicines as $checkupMedicine){
                        $dataAction = array();
                        $dataAction["name"] = $checkupMedicine->medicine->name; 
                        $dataAction["amount"] = $checkupMedicine->amount; 
                        $dataAction["price"] = 'Rp. ' . number_format($checkupMedicine->price, 0, '.', '.');; 
                        $dataAction["total"] = 'Rp. ' . number_format($checkupMedicine->price*$checkupMedicine->amount, 0, '.', '.'); 
                        $data["medicine"][] = $dataAction;
                    }
                }
                $response["data"] = $data;
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
