<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
use App\Patient;
use App\CheckupDiagnosis;
use App\CheckupAction;
use App\CheckupMedicine;
use Helper;
use Carbon\carbon;

class ExaminationController extends Controller
{
    private $title ="Data Pendafataran Pasien";
    private $icon ="<i class='fa fa-form'></i>";

    function index($register_id = null){
        $diagnosis ="";
        $actions ="";
        $medicines ="";
        $key = date("Y-m-d");
        $registers = Register::where('date_register', [$key, $key])->orderBy("no_register", "asc")->get();

        if($register_id != null){
            $diagnosis = CheckupDiagnosis::where('register_id' , $register_id)->get();
            $actions = CheckupAction::where('register_id' , $register_id)->get();
            $medicines = CheckupMedicine::where('register_id' , $register_id)->get();
        }
        return view('admin/examination_view', 
                    ['registers' => $registers,
                     'diagnosis' => $diagnosis,
                     'actions' => $actions,
                     'medicines' => $medicines,
                     'key' => $key,
                     'icon'=>$this->icon ,
                     'title' => $this->title]);
    }

    function destroyDiagnosa($id){

    }
}
