<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patient";

    protected $fillable=[
    	//"code", "name", "stock", "purchase_price", "sell_price", "unit"
    ];
}
