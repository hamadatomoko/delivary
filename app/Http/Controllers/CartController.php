<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Menu;

class CartController extends Controller
{
    public function index(Request $request)
    {
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
                // 商品IDでmenuモデルを絞り込む
                $menu = $menus->find($data['session_menu_id']);
                
                //二次元目の配列を指定している$dataに'product〜'key生成 Modelオブジェクト内の各カラムを代入
                //＆で参照渡し 仮引数($data)の変更で実引数($cartData)を更新する
                
                $data['menu_id'] = $menu->id;
                $data['product_name'] = $menu->name;
                $data['category_name'] = $menu->category->name;
                $data['price'] = $menu->price;
                $data['quantity'] = $data['session_quantity'];
                //商品小計の配列作成し、配列の追加
                $data['itemPrice'] = $data['price'] * $data['session_quantity'];
                $totalPrice += $data['itemPrice'];
            }
            // itemPriceに値段かける量に入れてあげている（それぞれの商品の合計が入っている）
            //  $totalPriceに合計値を足している。
            unset($data);
        }
        
        return view('cart.list', compact('cartData', 'totalPrice'));
    }
    
    public function addCart(Request $request)
    {
        
        // dd($request);
        // カート(session)の中身
        // cartData{
        //     [0] => {
        //                ['session_products_id'] => 2,
        //                ['session_quantity'] => 5,
        //            },
        //     [1] => {
        //                ['session_products_id'] => 5,
        //                ['session_quantity'] => 2,
        //            }
        // }
        //商品詳細画面のhidden属性で送信（Request）された商品IDと注文個数を取得し配列として変数に格納
        //inputタグのname属性を指定し$requestからPOST送信された内容を取得する。
        
        $cartData = [
            'session_menu_id' => $request->menuId,
            'session_quantity' => $request->quantity,
        ];

        //sessionにcartData配列が「無い」場合、商品情報の配列をcartData(key)という名で$cartDataをSessionに追加
        if (!$request->session()->has('cartData')) {
            $request->session()->push('cartData', $cartData);
        } else {
            //sessionにcartData配列が「有る」場合、情報取得
            $sessionCartData = $request->session()->get('cartData');

            //isSameProductId定義 product_id同一確認フラグ false = 同一ではない状態を指定
            $isSameProductId = false;
            foreach ($sessionCartData as $index => $sessionData) {
                //product_idが同一であれば、フラグをtrueにする → 個数の合算処理、及びセッション情報更新。更新は一度のみ

                if ($sessionData['session_menu_id'] === $cartData['session_menu_id']) {
                    $isSameProductId = true;
                    $quantity = $sessionData['session_quantity'] + $cartData['session_quantity'];
                    //cartDataをrootとしたツリー状の多次元連想配列の特定のValueにアクセスし、指定の変数でValueの上書き処理
                    $request->session()->put('cartData.' . $index . '.session_quantity', $quantity);
                    break;
                }
            }

            //product_idが同一ではない状態を指定 その場合であればpushする
            if ($isSameProductId === false) {
                $request->session()->push('cartData', $cartData);
            }
        }

        //POST送信された情報をsessionに保存 'users_id'(key)に$request内の'users_id'をセット
        $request->session()->put('users_id', ($request->users_id));
        // dd($cartData);
        return redirect()->route('cart.index');
    }
    
    
    public function deleteCart(Request $request)
    {
        // セッションからカートを取ってくる。
        $sessionCartData = $request->session()->get('cartData');
        
        $request->session()->forget('cartData');

        // 画面から送られた削除する商品を探す
        
        // カートから商品削除する
        
        foreach ($sessionCartData as $index => $sessionData) {
               
            // $sessionDataから、カートに指定された要素のメニューを探す。
                
            if ($sessionData['session_menu_id'] === $request->menuId) {
                //削除する商品が見つかったら削除する
                unset($sessionCartData[$index]);
                break;
            }
        }

        //セッションにカートを入れ直す
        if (!empty($sessionCartData) && count($sessionCartData) > 0) {
            $request->session()->put('cartData', $sessionCartData);
        }
        
        return redirect()->route('cart.index');
    }
}
