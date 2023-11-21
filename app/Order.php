<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = array('id');
   
    public static $rules = array(
    
        'orderd_at' => 'required',
        'user_id' => 'required',
        'order_status' => 'required',
        'estiimated_delivery_ time' => 'required',
        'total_money' => 'required|integer',
        'tax' => 'required',
        'memo' => 'required',
        
    );//
    
    public function save_order($user_id, $data)
    {
        $this->map($user_id, $data);
        $this->save();
    }
    
    public function map($user_id, $data)
    {
        // セッションからとってきたデータを加工,連想配列　からのインスタンスに具体的全ての値をセットする
        $this->user_id = $user_id;
        $this->estiimated_delivery_time = $data["appt"];
        $this->tel = $data["tel"];
        $this->address = $data["address"];
        $this->order_status = 0;
        $this->ordered_at = Carbon::now(); // 現在時刻
        $this->tax = $data["tax"];
        $this->memo = $data["memo"];
        // $this->syouyu = $data['syouyu'];
        // $this->hashi = $data['hashi'];
        $this->total_money = $data['total_money'];
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }//
    public function details()
    {
        return $this->hasMany('App\OrderDetail');
    }
}
