<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
class ActionController extends Controller
{
    private $title ="Data Tindakan";
    private $icon ="<i class='fa fa-database'></i>";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $actions = Action::when($request->key, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->key}%");
        })->paginate(10);;


        return view('admin/action_view',
                     ['actions' => $actions, 'key' => $key, 'icon'=>$this->icon ,'title' => $this->title]
                   );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/action_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = Action::create($request->all());
        if($action){
            session()->flash('success', 'Tambah Data Berhasil!!');
            return redirect('action');
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
        return view('admin/action_add', ['icon'=>$this->icon ,'title' => $this->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $action = Action::find($id);
         return view('admin/action_edit', ['action' => $action, 'icon'=>$this->icon , 'title' => $this->title]);
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
        $action = Action::find($id);
         if($action->update($request->all())){
            session()->flash('success', 'Update Data Berhasil!!');
            return redirect('action');
        }
        session()->flash('fail', 'Update Data Gagal!!');
        return redirect('action');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $action = Action::find($id);
         if($action->delete()){
            session()->flash('success', 'Hapus Data Berhasil!!');
            return redirect()->back();
         }
        session()->flash('fail', 'Data Terikat Dengan Data Lain!!');
        return redirect()->back();
    }
}
