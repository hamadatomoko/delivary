<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'name' => 'required',
        'details' => 'required',
        'category_id' => 'required',
        'customization' => 'required',
        'price' => 'required|integer',
        'required_time' => 'required',
    );
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
