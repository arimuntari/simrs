<?php
namespace App\Helper;
use route;
use DB;
class helpers {
    public static function cekAktif($aktif)
    {
       if($aktif != 1){
       	 return "<span class='badge bg-red'> Non-Active</span>";
       }else{
       	 return "<span class='badge bg-green'> Active</span>";
       }
    } 
    public static function tipeUser($tipe)
    {
       if($tipe == 1){
       	 return "Administrator";
       }elseif($tipe == 2){
       	 return "Kasir";
       }elseif($tipe == 3){
       	 return "Gudang";
       }
    }
    public static function toIndo($date) {
      $date = date('d/m/Y', strtotime(str_replace('-', '/', $date)));
      return $date;
    } 
    public static function formatIndo($tgl) {
      $dt = new  \Carbon\Carbon($tgl);
      setlocale(LC_TIME, 'IND');
        
      return $dt->formatLocalized('%e %b %Y %H:%M:%S'); // Senin, 3 September 2018 00:00:00
    } 
    public static function tglIndo($date){
      $dt = new  \Carbon\Carbon($date);
      setlocale(LC_TIME, 'IND');
      return $dt->formatLocalized('%e %b %Y'); // Senin, 3 September 2018
    }
    public static function toSQL($date){
      $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
      return $date;
    }
    public static function highLight($text, $key=''){
        $text = preg_replace('/(' . $key . ')/i', "<font style='color:red'>$1</font>", $text);
        return $text;
    }

    public static function codeSelling(){
      $row = DB::table('tr_selling')->orderBy('id', 'desc')->first();
      if(empty($row->kode_penjualan)){
        return "PJ00001";
      }else{
        return "PJ".str_pad($row->id + 1, 5, "0", STR_PAD_LEFT);
      }
    }
    public static function codePurchase(){
      $row = DB::table('tr_purchase')->orderBy('id', 'desc')->first();
      if(empty($row->kodePembelian)){
        return "PB00001";
      }else{
        return "PB".str_pad($row->id + 1, 5, "0", STR_PAD_LEFT);
      }
    }
    public static function codePatient(){
      $row = DB::table('patient')->orderBy('id', 'desc')->first();
      if(empty($row->code)){
        return "PT00001";
      }else{
        return "PT".str_pad($row->id + 1, 5, "0", STR_PAD_LEFT);
      }
    }
    public static function noRegister(){
      $date = date("Y-m-d");
      echo $date;
      $row = DB::table('register')->whereDate('date_register', $date)->orderBy('id', 'desc')->first();
      if(empty($row->no_register)){
        return 1;
      }else{
        return ($row->no_register+1);
      }
    }
    public static function searchItem($id, $array) {
      if(!empty($array)){
         foreach ($array as $key => $val) {
             if ($val['id_barang'] === $id) {
                 return $key;
             }
         }
      }

         return null; 
    }
}
?>