<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::all()->sortBy('name');
        return view('admin.order.index', compact('data'));
    }
    
    
    public function detail(Request $request, $id)
    {
        $order = Order::find($id);
        if (empty($order)) {
            abort(404);
        }
        // dd($order);
        return view('admin.order.detail', ['order_form' => $order]);
    }
    public function change_order_status(Request $request)
    {
        // $data = Order::all()->sortBy('name');
        // return redirect('admin/order');
        
        $order = Order::find($request->id);
        // 送信されてきたフォームデータを格納する
        $order->order_status = 1;
        //  配達状況を１にする

        
        $order->save();

        return redirect('admin/order');
    }
    //
}
