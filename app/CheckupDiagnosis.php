<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupDiagnosis extends Model
{
    protected $table = "checkup_diagnosis";


    protected $fillable=[
    	"register_id", "diagnosis_id"
    ];

     public function diagnosis()
    {
        return $this->belongsTo('App\Diagnosis', 'diagnosis_id', 'id');
    }
}
