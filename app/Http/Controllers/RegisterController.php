<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
use App\Patient;
use Helper;
use Carbon\carbon;

class RegisterController extends Controller
{
    private $title ="Data Pendafataran Pasien";
    private $icon ="<i class='fa fa-form'></i>";

    function index(Request $request){
        $key = $request->key;
        if(empty($key)){
            $key = date("Y-m-d");
        }
        $registers = Register::where('date_register', [$key, $key])->get();
       // dd($registers);
        return view('admin/register_view', ['registers' => $registers, 'key' => $key, 'icon'=>$this->icon , 'title' => $this->title]);
    }
    function store(Request $request){
        $codePatient = $request->code;
      //  echo $codePatient;
        $patient= Patient::where("code", $codePatient)->first();
        //dd($cekPatient);
        if($patient == null){     
            $patient = new Patient;
            $patient->code = Helper::codePatient();
            $patient->name = $request->name;
            $patient->birthdate = $request->birthdate;
            $patient->phone_number = $request->phone_number;
            $patient->address = $request->address;
            $patient->save();
        }

        $patient_id = $patient->id;     
        $register = new Register;
        $register->no_register = Helper::noRegister();
        $register->patient_id = $patient_id; 
        $register->date_register = Carbon::now();
        $register->time = Carbon::now();
        if($register->save()){  
            session()->flash('success', 'Insert Data Berhasil!! ');  
            return redirect('register');
        }
        session()->flash('fail', 'Insert Data Gagal!!');
        return redirect('register');
    }  
    function destroy($id){
        $register = Register::find($id);
        if($register->delete()){
            session()->flash('success', 'Delete Data Berhasil!! ');
            return redirect('register');
        }
        session()->flash('fail', 'Delete Data Gagal!! ');
        return redirect('register');
    }
}
