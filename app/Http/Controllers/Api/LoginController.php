<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use Helper;

class LoginController extends Controller
{
     function login(Request $request){
    	$user = Patient::where([  'code' => $request->code,
    						      'birthdate' => $request->birthdate 
    					   	   ])->first();
    	if($user){
            $response["errCode"] = "";
    		$response["errMessage"] = "";
    		$response["data"] =  array(
                     'id' => $user->id,
                     'code' => $user->code, 
                     'name' => $user->name, 
                     'birthdate' => $user->birthdate, 
                     'phone_number' => $user->phone_number,
                     'address' =>  $user->address);
    		
    	}else{
    		$response["errCode"] = "404";
			$response["errMessage"] = "Data Tidak Ditemukan";
    	}
    	
    	return json_encode($response);
    }
}
