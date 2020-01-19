<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;
use App\SaleItem;
use App\Purchase;
use App\PurchaseItem;
use App\Medicine;
class PrintController extends Controller
{
    function income(Request $request){
    	$date_start = $request->date_start;
    	if(empty($request->date_start)){
    		$date_start = date("Y-m-d"); 
    	}

    	$date_end = $request->date_end;
    	if(empty($request->date_end)){
    		$date_end = date("Y-m-d"); 
    	}
	    $title ="Laporan Pendapatan";
	    $income = Sale::whereBetween('sale_date', [$date_start, $date_end])->get();

        return view('admin/print_income', ['incomes' => $income, 'date_start' => $date_start,  'date_end' => $date_end,'title' => $title]);
    }

    function outcome(Request $request){
        $date_start = $request->date_start;
        if(empty($request->date_start)){
            $date_start = date("Y-m-d"); 
        }

        $date_end = $request->date_end;
        if(empty($request->date_end)){
            $date_end = date("Y-m-d"); 
        }
        $title ="Laporan Pengeluaran";
        $outcome = Purchase::whereBetween('purchase_date', [$date_start, $date_end])->get();

        return view('admin/print_outcome', ['outcomes' => $outcome, 'date_start' => $date_start,  'date_end' => $date_end, 'title' => $title]);
    }
    function opname(Request $request){
        $title ="Laporan Opname";
        $data = array();
        $medicines = Medicine::all();
        if($medicines){
            foreach($medicines as $medicine){
                $item["id"] = $medicine->id;
                $item["code"] = $medicine->code;
                $item["name"] = $medicine->name;
                $item["stock"] = $medicine->stock;
                $sell = SaleItem::where("medicine_id", $medicine->id)->sum("amount");
                $item["stock_minus"] = $sell;
                $buy = PurchaseItem::where("medicine_id", $medicine->id)->sum("amount");
                $item["stock_plus"] = $buy;
                $data[] = $item;
            }            
        }
        return view('admin/print_opname', ['items' => $data,'title' => $title]);
    }
}
