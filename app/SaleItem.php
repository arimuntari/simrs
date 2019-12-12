<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = "sale_item";

    public $timestamps = false;
    protected $fillable=[
    	"sale_id", "medicine_id", "amount", "price"
    ];

    
    public function medicine()
    {
        return $this->belongsTo('App\Medicine', 'medicine_id', 'id');
    }
    
    public function sale()
    {
        return $this->belongsTo('App\Sale', 'sale_id', 'id');
    }
}
