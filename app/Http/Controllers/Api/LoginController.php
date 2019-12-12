<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;

class LoginController extends Controller
{
     function login(Request $request){
    	$user = Patient::where(['code' => $request->code,
    						 'birthdate' => $request->birthdate 
    						])->first();
    	if($user){
    		$response["errMessage"] = "";
    		$response["data"] =  array(
                     'id' => $user->id,
                     'code' => $user->name, 
                     'name' => $user->name, 
    				 'phone_number' => $user->username,
    				 'address' =>  $user->password,
    				 'login_type' =>  $user->type);
    		
    	}else{
    		$response["errCode"] = "404";
			$response["errMessage"] = "Data Tidak Ditemukan";
    	}
    	
    	return json_encode($response);
    }
}
