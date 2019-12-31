<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $table = "purchase_item";

    public $timestamps = false;
    protected $fillable=[
    	"purchase_id", "medicine_id", "amount", "price"
    ];

    
    public function medicine()
    {
        return $this->belongsTo('App\Medicine', 'medicine_id', 'id');
    }
    
    public function purchase()
    {
        return $this->belongsTo('App\Purchase', 'purchase_id', 'id');
    }
}
