<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    function login(Request $request){
    	$user = User::where(['username' => $request->username,
    						 'password' => $request->password 
    						])->first();
    	if($user){
    		session(['login_name' => $user->name, 
                     'login_id' => $user->id,
    				 'login_username' => $user->username,
    				 'login_password' =>  $user->password,
    				 'login_type' =>  $user->type]);
    		return redirect('/index');
    	}else{
    		$request->session()->flash('status', 'Masukkan Password dengan Benar!!');
			return redirect('/');
    	}
    }

    function logout(Request $request){
     	$request->session()->flush();
     	return redirect('/');
    }
}
