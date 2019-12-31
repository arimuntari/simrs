<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseItem;
use App\Medicine;
use App\Helper\Helpers;

class PurchaseController extends Controller
{
    public $title = "Data Pembelian";
    private $icon ="<i class='fa fa-shopping-cart'></i>";

    public function index(Request $request){
    	$key = $request->key;
        $purchases = Purchase::when($request->key, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->key}%")->orWhere('code', 'like', "%{$request->key}%");
        })->paginate(10);
        return view('admin/purchase_view',
                     ['purchases' => $purchases, 'key' => $key, 'icon'=>$this->icon ,'title' => $this->title]
                   );
    }

    public function create(Request $request){
         $request->session()->forget('item');
    	return view('admin/purchase_add', ['title' => $this->title, 'icon' => $this->icon]);
    }
    public function saveItem(Request $request){
        if($request->medicine_id != '' and $request->amount > 0){
            $item = Medicine::find($request->medicine_id);
            if($item){
                $listitems = $request->session()->get('item');
                $key = Helpers::searchItem($item->id, $listitems);
                if(!is_null($key)){
                    unset($listitems[$key]);
                    $request->session()->put("item", $listitems);
                }
                $data = array(
	                        "medicine_id" =>$item->id,    
	                        "code" =>$item->code,                   
	                        "name" =>$item->name,
	                        "price" =>$request->price,
	                        "amount" => $request->amount,
	                        "price_total" => ($request->amount * $request->price)
	                    );
           
                 $request->session()->push('item', $data);
            }
        }else{
            echo "medicine_id Empty";
        }

    }
    public function listitem(Request $request){
        $listitems = $request->session()->get('item');
        if(!empty($listitems)){
            return view("admin/purchase_item", ['listitems' => $listitems]);
        }
    }

    public function destroyitem($key, Request $request){     
        $listitems = $request->session()->get('item');
        if(!is_null($key)){
            unset($listitems[$key]);
            $request->session()->put("item", $listitems);
        }
        if(!empty($listitems)){
            return view("admin/purchase_item", ['listitems' => $listitems]);
        }
    }
    public function store(Request $request){
        $listitems = $request->session()->get('item');
        if(!empty($listitems)){
            $purchase = new Purchase;
            $purchase->code = Helpers::codePurchase();
            $purchase->purchase_date = $request->purchase_date;
            $purchase->users_id = $request->session()->get('login_id');
            $purchase->price_total = $request->total;
            $purchase->save();
            foreach($listitems as $item){
                $purchaseItem = new PurchaseItem;
                $purchaseItem->purchase_id = $purchase->id;
                $purchaseItem->medicine_id = $item['medicine_id'];
                $purchaseItem->price = $item['price'];
                $purchaseItem->amount = $item['amount'];
                $purchaseItem->save();

                $medicine = Medicine::find($item['medicine_id']);
                $medicine->purchase_price = $item['price'];
                $medicine->stock = $medicine->stock +  $purchaseItem->amount ;
                $medicine->update();
            }
            $request->session()->flash('status', 'Insert Penjualan Berhasil!!');
            return redirect('purchase');
        }else{
            $request->session()->flash('status', 'Anda Belum Memasukkan Barang!!');
            return redirect('purchase/create');
        }

    }
    public function destroy($id){
        $sellitems = PurchaseItem::where("sale_id", $id)->get();
        foreach($sellitems as $lisitem){
            $medicine = Medicine::find($lisitem->medicine_id);
            $medicine->stock = $medicine->stock + $lisitem->amount ;
            $medicine->update();

            $lisitem->delete();
        }
        $purchase = Purchase::find($id);
        $purchase->delete();
          return redirect('purchase');
    }
    public function detail($id){
        $purchase["detail"] = Purchase::where('id', $id)->first();
        $purchase["item"] = Purchase::where('id', $id)->first()->PurchaseItem;
        return view("admin/purchase_detail", ['purchase' => $purchase, 'title' => $this->title, 'icon' => $this->icon]); 
    }
}
