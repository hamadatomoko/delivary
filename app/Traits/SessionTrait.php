<?php
namespace App\Traits;

use App\Menu;
use Illuminate\Http\Request;

trait SessionTrait
{
    public function getCartDatafromSession(Request $request)
    {
        $cartData = array();
        
        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }
        
        $totalPrice = 0;
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
                $data['wasabi'] = $data['session_wasabi'];
                $data['large'] = $data['session_large'];
                //商品小計の配列作成し、配列の追加
                $data['itemPrice'] = $data['price'] * $data['session_quantity'];
                $totalPrice += $data['itemPrice'];
            }
            unset($data);
        }
        
        return array($cartData, $totalPrice);
    }
    
   
    
    public function set_session(Request $request)
    {
        $request->session()->put('address', $request->address); // 住所       値を保存する
        $request->session()->put('tel', $request->tel); // 電話番号
        $request->session()->put('appt', $request->appt); // ご希望時間
        $request->session()->put('memo', $request->memo);
        $request->session()->put('syouyu', $request->syouyu);
        $request->session()->put('hashi', $request->hashi);
    }
    public function get_session_data(Request $request, $key)
    {
        $sessionCartData = $request->session()->get($key);
        $request->session()->forget($key);
        return $sessionCartData;
    }
    public function delete_session_data(Request $request)
    {
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
    }
}
