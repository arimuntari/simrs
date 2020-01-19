<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;
use App\SaleItem;
use App\Purchase;
use App\PurchaseItem;
use App\Medicine;

class ReportController extends Controller
{

	private $icon ="<i class='fa fa-form'></i>";
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
	    $income = Sale::whereBetween('sale_date', [$date_start, $date_end])->paginate(10);

        return view('admin/report_income', ['incomes' => $income, 'date_start' => $date_start,  'date_end' => $date_end, 'icon'=>$this->icon , 'title' => $title]);
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
        $outcome = Purchase::whereBetween('purchase_date', [$date_start, $date_end])->paginate(10);

        return view('admin/report_outcome', ['outcomes' => $outcome, 'date_start' => $date_start,  'date_end' => $date_end, 'icon'=>$this->icon , 'title' => $title]);
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
        return view('admin/report_opname', ['items' => $data, 'icon'=>$this->icon , 'title' => $title]);
    }
}
