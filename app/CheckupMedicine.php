<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupMedicine extends Model
{
    protected $table = "checkup_medicine";

	public $timestamps = false;
    protected $fillable=[
    	"register_id", "medicine_id", "amount", "price"
    ];

    public function medicine()
    {
        return $this->belongsTo('App\Medicine', 'medicine_id', 'id');
    }

}
