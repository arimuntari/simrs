<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\User;
use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('login_name')){
            $session = $request->session()->all();
            $user = User::where(['username' => $session['login_username'],
                                 'password' => $session['login_password']
                                ])->first();
            if(!$user){
                $request->session()->flash('status', 'Silahkan Login Terlebih Dahulu!!');
                return redirect('/');
            }
        }else{  
            $request->session()->flash('status', 'Silahkan Login Terlebih Dahulu!!');
            return redirect('/');
        }
        return $next($request);
    }
}
