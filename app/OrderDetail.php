<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = array('id');
   
    public static $rules = array(
        'ID' => 'required',
        'orderd_id' => 'required',
        'menu_id' => 'required',
        'quantity' => 'required',
        'wasabi' => 'required',
        'large' => 'required',
        'total_money' => 'required|integer',
        'tax' => 'required',
        'memo' => 'required',
    );
    public function user()
    {
        return $this->belongsTo('App\User');
    }//
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
