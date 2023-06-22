<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;

class OrderController extends Controller
{
    public function information(Request $request)
    {
        $order = new Order;
        $order->address = Auth::user()->address;
        $order->tel = Auth::user()->tel;
        return view('order.order-imfomation');
    }
    
    // お届け先と時間を確認する画面を表示
    public function confirm(Request $request)
    {
        // バリデーションチェック(できたら)
        
        // 注文情報をセッションへ登録
        $request->session()->put('', 'todo'); // 住所
        $request->session()->put('', 'todo'); // 電話番号
        $request->session()->put('', 'todo'); // ご希望時間
        
        // 前画面から来た注文情報とセッションから、
        // カートの情報を取り出し確認画面へ渡す(CartController.indexアクションを参考)
        
        
        return view('menu.detail', ["order" => $order]);
    }
    
    // 注文を確定するアクション（databaseのorderstableに追加）
    public function complete(Request $request)
    {
        return redirect('menu/create');
    }
    //
}
