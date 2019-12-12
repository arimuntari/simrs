<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = "sale_item";

    protected $fillable=[
    	"sale_id", "medicine_id", "amount", "price"
    ];

    protected $attributes=[
    	"price_total" => 0
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
