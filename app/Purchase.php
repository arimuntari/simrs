<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = "purchase";

    protected $fillable=[
    	"code", "purchase_date", "price_total", "users_id"
    ];

    protected $attributes=[
    	"price_total" => 0
    ];

    public function User()
    {
        return $this->belongsTo('App\User', 'users_id', 'id');
    }
    public function PurchaseItem(){
    	 return $this->hasMany('App\PurchaseItem', 'purchase_id', 'id');
    }
}
