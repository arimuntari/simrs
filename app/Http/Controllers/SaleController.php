<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\SaleItem;
use App\Medicine;
use App\Helper\Helpers;
class SaleController extends Controller
{
    public $title = "Data Penjualan";
    private $icon ="<i class='fa fa-shopping-cart'></i>";

    public function index(Request $request){
    	$key = $request->key;
        $sales = Sale::when($request->key, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->key}%")->orWhere('code', 'like', "%{$request->key}%");
        })->paginate(10);
        return view('admin/sale_view',
                     ['sales' => $sales, 'key' => $key, 'icon'=>$this->icon ,'title' => $this->title]
                   );
    }

    public function create(Request $request){
         $request->session()->forget('item');
    	return view('admin/sale_add', ['title' => $this->title, 'icon' => $this->icon]);
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
	                        "price" =>$item->sell_price,
	                        "amount" => $request->amount,
	                        "price_total" => ($request->amount * $item->sell_price)
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
            return view("admin/sale_item", ['listitems' => $listitems]);
        }
    }

    public function destroyitem($key, Request $request){     
        $listitems = $request->session()->get('item');
        if(!is_null($key)){
            unset($listitems[$key]);
            $request->session()->put("item", $listitems);
        }
        if(!empty($listitems)){
            return view("admin/sale_item", ['listitems' => $listitems]);
        }
    }
    public function store(Request $request){
        $listitems = $request->session()->get('item');
        if(!empty($listitems)){
            $sale = new Sale;
            $sale->code = Helpers::codeSale();
            $sale->sale_date = $request->sale_date;
            $sale->users_id = $request->session()->get('login_id');
            $sale->price_total = $request->total;
            $sale->save();
            foreach($listitems as $item){
                $saleItem = new SaleItem;
                $saleItem->sale_id = $sale->id;
                $saleItem->medicine_id = $item['medicine_id'];
                $saleItem->price = $item['price'];
                $saleItem->amount = $item['amount'];
                $saleItem->save();

                $medicine = Medicine::find($item['medicine_id']);
                $medicine->stock = $medicine->stock -  $saleItem->amount ;
                $medicine->update();
            }
            $request->session()->flash('status', 'Insert Penjualan Berhasil!!');
            return redirect('sale');
        }else{
            $request->session()->flash('status', 'Anda Belum Memasukkan Barang!!');
            return redirect('sale/create');
        }

    }
    public function destroy($id){
        $saleItems = SaleItem::where("sale_id", $id)->get();
        foreach($saleItems as $listItem){
            $medicine = Medicine::find($listItem->medicine_id);
            $medicine->stock = $medicine->stock + $listItem->amount ;
            $medicine->update();

            $listItem->delete();
        }
        $sale = Sale::find($id);
        $sale->delete();
        return redirect('sale');
    }
    public function detail($id){
        $sale["detail"] = Sale::where('id', $id)->first();
        $sale["item"] = Sale::where('id', $id)->first()->SaleItem;
        return view("admin/sale_detail", ['sale' => $sale, 'title' => $this->title, 'icon' => $this->icon]); 
    }
}
