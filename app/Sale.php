<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = "sale";

    protected $fillable=[
    	"code", "sale_date", "price_total", "users_id"
    ];

    protected $attributes=[
    	"price_total" => 0
    ];

    public function User()
    {
        return $this->belongsTo('App\User', 'users_id', 'id');
    }
    public function SaleItem(){
    	 return $this->hasMany('App\SaleItem', 'sale_id', 'id');
    }
}
