<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Sale;
use App\SaleItem;
use App\Purchase;
use App\PurchaseItem;
use App\Medicine;

class DashboardController extends Controller
{
    function index(Request $request){
    	$title = "Dashboard";
        $date_start = $request->date_start;
        if(empty($request->date_start)){
            $date_start = date("2019-12-01"); 
        }

        $date_end = $request->date_end;
        if(empty($request->date_end)){
            $date_end = date("Y-m-d"); 
        }


        $outcome = Purchase::whereBetween('purchase_date', [$date_start, $date_end])->orderBy("purchase_date", "asc")->get()->groupBy("purchase_date")->map(function ($row) { 
            return $row->sum('price_total');
        });
        if($outcome){
            foreach($outcome as $key=>$value){
                $date[] = $key;
                $purchase[] = array($key, $value);
            }

        }


        $income = Sale::whereBetween('sale_date', [$date_start, $date_end])->orderBy("sale_date", "asc")->get()->groupBy("sale_date")->map(function ($row) { 
            return $row->sum('price_total');
        });
        if($income){
            foreach($income as $key=>$value){
                $sale[] = array($key, $value);
            }

        }
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

        return view('admin/index', ['purchase' => $purchase, 'sale' => $sale,'date' => $date,'items' => $data, 'title' => $title, 'date_start' => $date_start,  'date_end' => $date_end]);
    }
}
