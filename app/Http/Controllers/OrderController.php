<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;

class OrderController extends Controller
{
    use \App\Traits\SessionTrait;
    
    public function information(Request $request)
    {
        // 現在認証しているユーザーを取得
        $order = new Order;
        $order->address = Auth::user()->address;
        $order->tel = Auth::user()->tel;

        
        // 時間のチェック（こちらで設定した時間で入力してもらう）
        $minTime = Carbon::now()->formatLocalized('%Y-%m-%dT%h:%M:%s');
        $maxTime = "2023-06-29T21:00";
        return view('order.order-imfomation', compact('minTime', 'maxTime', 'order'));
    }
    
    // お届け先と時間を確認する画面を表示
    public function confirm(Request $request)
    {
        // バリデーションチェック(できたら)
        // $carbon = new Carbon($request->appt);
    
        // 注文情報をセッションへ登録
        $this->set_session($request);
        // 前画面から来た注文情報とセッションから、
        // カートの情報を取り出し確認画面へ渡す(CartController.indexアクションを参考)
        
        $address = $request->address;
        $tel = $request->tel;
        $appt = $request->appt;
        $syouyu = $request->syouyu;
        
        list($cartData, $totalPrice) = $this->getCartDatafromSession($request);
        
        $tax = $totalPrice * 1.08; //1.08を定数で定義する。
       
        return view('order.order-confirm', compact("address", "tel", "appt", 'cartData', "memo", 'totalPrice', "tax", 'syouyu', 'hashi'));
    }
    
    // 注文を確定するアクション（databaseのorderstableに追加）
    public function complete(Request $request)
    {
        // 1.セッションからカート情報を取得
        // putではなくget
        $data = $request->session()->all();
        dd($request);
        $tel = $data["tel"];
        $appt = $data["appt"];
        $address = $data["address"];
        $cartData = $data["cartData"];

        // 2.データベースへ保存
        $order = new Order;
        // orderテーブルのidが付与される。
        // ordersテーブルにデータを１件追加
        $order->save_order(\Auth::id(), $data);
        
        // order_detailsテーブルに複数件のデータを追加。
        foreach ($cartData as $item) {
            //  商品＄cに商品情報が入れる
            // カートデータに複数の商品が入っているからforeachを使う
            $d= new OrderDetail;
            //  注文詳細に注文番号を入れる。
        // order_detailのmenu_idに代入する
            $d->order_id = $order->id; //配列ではなく、インスタンスなので->を使う
            $d->menu_id = $item['session_menu_id'];
            $d->quantity = $item['session_quantity'];
            $d->wasabi = $request->wasabi[$i] == true ? 1 : 0;
            $d->large  =$request->large[$i] == true ? 1 : 0;
         
            $d->save();
        }
        
        // 4.セッションからカート情報等を削除
        $this->delete_session_data($request);
        
        return view('order.complete');
    }
}
