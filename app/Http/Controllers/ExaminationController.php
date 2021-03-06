<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Register;
use App\Patient;
use App\CheckupDiagnosis;
use App\CheckupAction;
use App\CheckupMedicine;
use App\Medicine;
use Helper;
use Carbon\carbon;

class ExaminationController extends Controller
{
    private $title ="Data Pendafataran Pasien";
    private $icon ="<i class='fa fa-form'></i>";

    function index(Request $request, $register_id = null){
        $diagnosis ="";
        $actions ="";
        $medicines ="";
        $key = $request->key;
        if(empty($key)){
            $key = date("Y-m-d");
        }
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
                     'register_id' => $register_id,
                     'key' => $key,
                     'icon'=>$this->icon ,
                     'title' => $this->title]);
    }

    function storeDiagnosis(Request $request){
        try{
            $checkupDiagnosis = CheckupDiagnosis::create($request->all());
            if($checkupDiagnosis){
                session()->flash('success', 'Tambah Data Berhasil!!');
                return redirect()->route('exam.view', $request->register_id);
            }
        }catch (Exception $e){
            session()->flash('fail', 'Tambah Data Gagal!!, '.$e);
        }
        return redirect()->back();
    }
    function destroyDiagnosis($id){
        $checkup = CheckupDiagnosis::find($id);
        if($checkup->delete()){
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
        }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }

    function storeAction(Request $request){
        $checkup = CheckupAction::create($request->all());
        if($checkup){
            session()->flash('success', 'Tambah Data Berhasil!!');
            return redirect()->route('exam.view', $request->register_id);
        }
        return redirect()->back();
    }
    function destroyAction($id){
        $checkup = CheckupAction::find($id);
        if($checkup->delete()){
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
        }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }

    function storeMedicine(Request $request){
        $checkup = CheckupMedicine::create($request->all());
        if($checkup){
            $medicine = Medicine::find($request->medicine_id);
            $medicine->stock = $medicine->stock - $request->amount;
            $medicine->save();
            session()->flash('success', 'Tambah Data Berhasil!!');
            return redirect()->route('exam.view', $request->register_id);
        }
        return redirect()->back();
    }
    function destroyMedicine($id){
        $checkup = CheckupMedicine::find($id);
        $amount = $checkup->amount;
        $medicine_id = $checkup->medicine_id;
        if($checkup->delete()){
            $medicine = Medicine::find($medicine_id);
            $medicine->stock = $medicine->stock + $amount;
            $medicine->save();
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
        }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }
    function saveExam(Request $request){
        $id = $request->register_id;
        $register = Register::find($id);
        $register->price_total = $request->price_total;
        $register->status = 1;
        if($register->save()){
            session()->flash('success', 'Pemeriksaan Selesail!!');
            return redirect()->back();
        }
        session()->flash('fail', 'Pemeriksaan error!!');
        return redirect()->back();
    }
}
