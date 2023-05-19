<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::all();
        //dd($posts);
        
        //取得したデータを画面へ渡す
        return view('menu.index', ['data' => $data]);
    }
    public function show(Request $request)
    {
        return view('menu.detail', ["order" => Order::find($request->id)]);
    }
    public function cart(Request $request)
    {
        return redirect('menu/cart');
    }
    // お届け先と時間を入力する画面を表示
    public function add(Request $request)
    {
        $order = new Order;
        $order->address = Auth::user()->address;
        $order->tel = Auth::user()->tel;
        return view('order.cartlist', ["order" => $order]);
    }
    // お届け先と時間を確認する画面を表示
    public function comfirm(Request $request)
    {
        return view('menu.detail', ["order" => $order]);
    }
    // 注文を確定するアクション（databaseのorderstableに追加）
    public function complete(Request $request)
    {
        return redirect('menu/create');
    }
    
    
    //
}
