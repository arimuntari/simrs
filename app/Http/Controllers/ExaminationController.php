<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
use App\Patient;
use Helper;
use Carbon\carbon;

class ExaminationController extends Controller
{
    private $title ="Data Pendafataran Pasien";
    private $icon ="<i class='fa fa-form'></i>";

    function index(Request $request){
        $key = $request->key;
        if(empty($key)){
            $key = date("Y-m-d");
        }
        $registers = Register::where('date_register', [$key, $key])->orderBy("no_register", "asc")->get();
       
        return view('admin/examination_view', ['registers' => $registers, 'key' => $key, 'icon'=>$this->icon , 'title' => $this->title]);
    }
    function destroyDiagnosa($id){

    }
}
