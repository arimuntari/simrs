<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
     protected $table = "register";

    protected $fillable=[
    	"no_register", "patient_id", "date_register", "time"
    ];

    protected $attributes=[
    	"status" => 0,
    	"price_total" => 0
    ];
     public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }
}
