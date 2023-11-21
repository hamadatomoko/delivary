<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UtlTrait
{
    public function tax($price)
    {
        // return $price * 1.1 . "円(税込)";
        // 切り捨てにすれば良い
        return $price * 1.1;
    }
}
