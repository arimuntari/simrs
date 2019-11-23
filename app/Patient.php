<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patient";

    protected $fillable=[
    	"code", "name", "birthdate", "phone_number", "address"
    ];
}
