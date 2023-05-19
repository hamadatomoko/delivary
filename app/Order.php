<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = array('id');
   
    public static $rules = array(
    
        'orderd_at' => 'required',
        'user_id' => 'required',
        'order_status' => 'required',
        'estiimated _delivery_ time' => 'required',
        'total_money' => 'required|integer',
        'tax' => 'required',
        'memo' => 'required',
    );//
    public function user()
    {
        return $this->belongsTo('App\User');
    }//
}
