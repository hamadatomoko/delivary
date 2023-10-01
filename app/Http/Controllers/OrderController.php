<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use App\Traits\SessionTrait;

class OrderController extends Controller
{
    use SessionTrait;
    public function information(Request $request)
    {
        // 現在認証しているユーザーを取得
        $order = new Order;
        $order->address = Auth::user()->address;
        $order->tel = Auth::user()->tel;
        // dd($order);
        
        // 時間のチェック（こちらで設定した時間で入力してもらう）
        $minTime = Carbon::now()->formatLocalized('%Y-%m-%dT%h:%M:%s');
        $maxTime = "2023-06-29T21:00";
        return view('order.order-imfomation', compact('minTime', 'maxTime', 'order'));
    }
    
    // お届け先と時間を確認する画面を表示
    public function confirm(Request $request)
    {
        // dd("確認へ");
        // バリデーションチェック(できたら)
        $carbon = new Carbon($request->appt);
        // dd($carbon);
        
        // 注文情報をセッションへ登録
        // $request->session()->put('address', $request->address); // 住所       値を保存する
        // $request->session()->put('tel', $request->tel); // 電話番号
        // $request->session()->put('appt', $request->appt); // ご希望時間
        // $request->session()->put('memo', $request->memo);
        // $request->session()->put('syouyu', $request->syouyu);
        // $request->session()->put('hashi', $request->hashi);
        $this->set_session($request);
        // 前画面から来た注文情報とセッションから、
        // カートの情報を取り出し確認画面へ渡す(CartController.indexアクションを参考)
        
        $address = $request->address;
        $tel = $request->tel;
        $appt = $request->appt;
        $syouyu = $request->syouyu;
        $tax = 0;
        // dd($address, $tel, $appt);
        $totalPrice = 0;
        
        $cartData = array();
        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
            // dd($cartData);
        }
        // 引数にセッションキーを指定することでそのキーの値を取得することができます
        if (!empty($cartData)) {
            $sessionProductsId = array_column($cartData, 'session_menu_id');
            $menus = Menu::find($sessionProductsId);
            foreach ($cartData as $index => &$data) {
                // 商品IDでmenuモデルを絞り込む　&をつけることにによって、cartData対象のdataを更新できる
                $menu = $menus->find($data['session_menu_id']);
                
                //二次元目の配列を指定している$dataに'product〜'key生成 Modelオブジェクト内の各カラムを代入
                //＆で参照渡し 仮引数($data)の変更で実引数($cartData)を更新する
                // sessionの値を更新している
                $data['menu_id'] = $menu->id;
                $data['product_name'] = $menu->name;
                $data['category_name'] = $menu->category->name;
                $data['price'] = $menu->price;
                $data['quantity'] = $data['session_quantity'];
                //商品小計の配列作成し、配列の追加
                $data['itemPrice'] = $data['price'] * $data['session_quantity'];
                $totalPrice += $data['itemPrice'];
            }
            $tax = $totalPrice * 1.08; //1.08を定数で定義する。
            $request->session()->put('total_money', $totalPrice);
            $request->session()->put('tax', $tax);
            
            // itemPriceに値段かける量に入れてあげている（それぞれの商品の合計が入っている）
            //  $totalPriceに合計値を足している。
            unset($data);
        }
        // dd($sessionCartData);
        return view('order.order-confirm', compact("address", "tel", "appt", 'cartData', "memo", 'totalPrice', "tax", 'syouyu', 'hashi'));
    }
    
    // 注文を確定するアクション（databaseのorderstableに追加）
    public function complete(Request $request)
    {
        // 1.セッションからカート情報を取得
        // putではなくget
        $data = $request->session()->all();
        // dd($data);
        $tel = $data["tel"];
        // dd($tel);
        $appt = $data["appt"];
        // dd($appt);
        $address = $data["address"];
        // dd($address);
        $cartData = $data["cartData"];
        // dd($cartData);
        // dd($user_id);
        // 2.セッションからとってきたデータを加工,連想配列　からのインスタンスに具体的全ての値をセットする
        $order = new Order;
        // orderテーブルのidが付与される。
        $order->save_order(\Auth::id(), $data);
       
        // dd($order);
        
        
        
        foreach ($cartData as $item) {
            //  商品＄cに商品情報が入れる
            // カートデータに複数の商品が入っているからforeachを使う
            $d= new OrderDetail;
            //  注文詳細に注文番号を入れる。
        // order_detailのmenu_idに代入する
            $d->order_id = $order->id; //配列ではなく、インスタンスなので->を使う
            $d->menu_id = $item['session_menu_id'];
            $d->quantity = $item['session_quantity'];
            $d->wasabi = 1;
            $d->large= 1;
         
            $d->save();
        }
        //  $oder = [$data->]
//        $news = new News;
//        $form = $request->all();
//
//        // フォームから送信されてきた_tokenを削除する
//        unset($form['_token']);
//
//        // データベースに保存する
//        $news->fill($form);
//        $news->save();
        
        
        
        // 3.データベースへ保存
        // $oder =
        // $oder_detail =
        
        //ordersテーブルにデータを１件追加
        // order_detailsテーブルに複数件のデータを追加。
        
        // 4.セッションからカート情報等を削除
        $request->session()->forget([
            'address',
            'tel',
            'appt',
            'memo',
            'syouyu',
            'hashi',
            'cartData',
            'users_id',
            'total_money',
            'tax',
        ]);
        
        return view('order.complete');
    }
    
    // private function set_session(Request $request)
    // {
    //     $request->session()->put('address', $request->address); // 住所       値を保存する
    //     $request->session()->put('tel', $request->tel); // 電話番号
    //     $request->session()->put('appt', $request->appt); // ご希望時間
    //     $request->session()->put('memo', $request->memo);
    //     $request->session()->put('syouyu', $request->syouyu);
    //     $request->session()->put('hashi', $request->hashi);
    // }
    
    //
}
// / 注文をDBに追加
// // $orderにIDが入る
// $order->save();
// // カートの商品に注文番号を追加
// foreach($cart as $item) {
//   // 商品に注文番号を設定
//   $item->orderId = $order->id;
//   // DBに商品を追加
//   $item->save();
// }
