<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupMedicine extends Model
{
    protected $table = "checkup_medicine";


    protected $fillable=[
    	"register_id", "medicine_id", "amount", "price"
    ];
}
