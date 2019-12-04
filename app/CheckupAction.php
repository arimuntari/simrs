<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupAction extends Model
{
    protected $table = "checkup_action";


    protected $fillable=[
    	"register_id", "action_id", "price"
    ];
    
    public function action()
    {
        return $this->belongsTo('App\Action', 'action_id', 'id');
    }
}
