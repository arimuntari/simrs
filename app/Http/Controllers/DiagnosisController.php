<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnosis;
class DiagnosisController extends Controller
{
    private $title ="Data Diagnosa";
    private $icon ="<i class='fa fa-database'></i>";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $diagnoses = Diagnosis::when($request->key, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->key}%");
        })->paginate(10);;


        return view('admin/diagnosis_view',
                     ['diagnoses' => $diagnoses, 'key' => $key, 'icon'=>$this->icon ,'title' => $this->title]
                   );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/diagnosis_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diagnosis = Diagnosis::create($request->all());
        if($diagnosis){
            session()->flash('success', 'Tambah Data Berhasil!!');
            return redirect('diagnosis');
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
        return view('admin/diagnosis_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $diagnosis = Diagnosis::find($id);
         return view('admin/diagnosis_edit', ['diagnosis' => $diagnosis, 'icon'=>$this->icon , 'title' => $this->title]);
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
        $diagnosis = Diagnosis::find($id);
         if($diagnosis->update($request->all())){
            session()->flash('success', 'Update Data Berhasil!!');
            return redirect('diagnosis');
        }
        session()->flash('fail', 'Update Data Gagal!!');
        return redirect('diagnosis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $diagnosis = Diagnosis::find($id);
         if($diagnosis->delete()){
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
         }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }
}
