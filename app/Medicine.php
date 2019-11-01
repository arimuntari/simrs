<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = "medicine";

    protected $fillable=[
    	"code", "name", "stock", "purchase_price", "sell_price", "unit"
    ];
    
}
