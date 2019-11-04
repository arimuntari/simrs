<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
class PatientController extends Controller
{
    private $title ="Data Pasien";
    private $icon ="<i class='fa fa-database'></i>";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $patients = Patient::when($request->key, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->key}%")->orWhere('code', 'like', "%{$request->key}%");
        })->paginate(10);;


        return view('admin/patient_view',
                     ['patients' => $patients, 'key' => $key, 'icon'=>$this->icon ,'title' => $this->title]
                   );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/patient_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::create($request->all());
        if($patient){
            session()->flash('success', 'Tambah Data Berhasil!!');
            return redirect('patient');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin/patient_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $patient = Patient::find($id);
         return view('admin/patient_edit', ['patient' => $patient, 'icon'=>$this->icon , 'title' => $this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
         if($patient->update($request->all())){
            session()->flash('success', 'Update Data Berhasil!!');
            return redirect('patient');
        }
        session()->flash('fail', 'Update Data Gagal!!');
        return redirect('patient');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $patient = Patient::find($id);
         if($patient->delete()){
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
         }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }
}
