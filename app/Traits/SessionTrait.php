<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait SessionTrait
{
    public function set_session(Request $request)
    {
        $request->session()->put('address', $request->address); // 住所       値を保存する
        $request->session()->put('tel', $request->tel); // 電話番号
        $request->session()->put('appt', $request->appt); // ご希望時間
        $request->session()->put('memo', $request->memo);
        $request->session()->put('syouyu', $request->syouyu);
        $request->session()->put('hashi', $request->hashi);
    }
}
