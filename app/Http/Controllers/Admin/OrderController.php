<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use App\Menu;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        
        
            // 未配達の情報をを取得する
        $orders = Order::where('order_status', 0)->get();
        // $requestのorder_statusを取得して、てbladeファイルに渡す。
        $order_status = $request->order_status;
        
        // dd($orders);
        return view('admin.order.index', ['orders' => $orders, 'order_status' => $order_status]);
    }
       
    
    
    public function detail(Request $request, $id)
    {
        $order = Order::find($id);
        if (empty($order)) {
            abort(404);
        }
        // dd($order->details());
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
    public function edit($id)
    {
        $order = Order::find($id);
        if (empty($order)) {
            abort(404);
        }
        // dd($order);
        $minTime = Carbon::now()->formatLocalized('%Y-%m-%dT%h:%M:%s');
        $menu = Menu::all();
        $order_detail = OrderDetail::where('order_id', $id)->get();
        return view('admin.order.edit', compact(['order', 'minTime', 'menu','order_detail']));
    }
    
    public function update(Request $request)
    {
        // dd($request);
        // 例外処理
        try {
            // DBトランザクション開始
            DB::beginTransaction();
            
            // 注文の更新 -----------------------------------------------
            $order = Order::find($request->id);
            // 送信されてきたフォームデータを格納する
            $order_form = $request->all();
            // 注文更新の際、不要なデータ除外
            unset($order_form['_token']);
            unset($order_form['menu_id']);
            unset($order_form['quantity']);
            // 合計金額と税の計算 :todo
            // 該当するデータを上書きして保存する
            $order->fill($order_form)->save();
            
            // 注文詳細のデリートインサート -----------------------------
            // 該当注文の詳細データを一旦全て削除する。
            // 今回はメニューの追加/削除の概念があるので、
            // 単純にデリートインサートを実施する
            OrderDetail::where('order_id', $order->id)->delete();
            // 注文詳細の登録

            for ($i = 0;  $i < count($request->menu_id); $i++) {
                if ($request->menu_id[$i] != null) {
                    $data =new OrderDetail;
                    $data->order_id = $order->id;
                    //商品番号の配列から取って来たmenu_idを保存する。
                    $data->menu_id = $request->menu_id[$i];
                    $data->quantity = $request->quantity[$i];
                    // $data->wasabi = $request->wasabi[$i];
                    // $data->large  =$request-> large[$i];
                    $data->wasabi = 1;
                    $data->large  = 1;
                    $res = $data->save();
                }
            }
                
            // トランザクション確定
            DB::commit();
        } catch (Throwable $e) {
            // トランザクションロールバック
            DB::rollBack();
        }
        
        return redirect("admin/order/detail/$order->id");
    }
    


    // public function update(Request $request)
    // {
    //     $order_id = $request->id;
    //     // dd($request);
    //     // 該当注文の詳細データを一旦全て削除する。
    //     // OrderDetail::where('order_id', $order_id)->delete();
    //     // 詳細の登録
    //     for ($i = 0;  $i < count($request->menu_id); $i++) {
    //         if ($request->menu_id[$i] != null) {
    //             $data =OrdeDetail::find($menu_id[$id]);
    //             $data->order_id = $order_id;
    //             //商品番号の配列から取って来たmenu_idを保存する。
    //             $data->menu_id = $request->menu_id[$i];
    //             $data->quantity = $request->quantity[$i];
    //             $data->wasabi = 1;
    //             $data->large  =1;
    //             $res = $data->save();
    //         }
    //     }
    //     return redirect("admin/order/detail/$order_id");
    // }
}
