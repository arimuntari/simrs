<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;
class medicineController extends Controller
{
    private $title ="Data Obat";
    private $icon ="<i class='fa fa-database'></i>";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $medicines = Medicine::when($request->key, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->key}%")->orWhere('code', 'like', "%{$request->key}%");
        })->paginate(10);;


        return view('admin/medicine_view',
                     ['medicines' => $medicines, 'key' => $key, 'icon'=>$this->icon ,'title' => $this->title]
                   );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/medicine_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicine = Medicine::create($request->all());
        if($medicine){
            session()->flash('success', 'Tambah Data Berhasil!!');
            return redirect('medicine');
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
        return view('admin/medicine_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $medicine = Medicine::find($id);
         return view('admin/medicine_edit', ['medicine' => $medicine, 'icon'=>$this->icon , 'title' => $this->title]);
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
        $medicine = Medicine::find($id);
         if($medicine->update($request->all())){
            session()->flash('success', 'Update Data Berhasil!!');
            return redirect('medicine');
        }
        session()->flash('fail', 'Update Data Gagal!!');
        return redirect('medicine');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $medicine = Medicine::find($id);
         if($medicine->delete()){
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
         }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }
}
