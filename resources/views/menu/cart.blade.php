
<div class="container">
    <div class="wrapper-title">
        <h3>MY CART</h3>
        <p>カート</p>
    </div>
    <div class="cartlist">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>個数</th>
                    <th>小計</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <p>{{ $menu->name }}</p>
                    <p>{{ $menu->price }}</p>
                    <p>{{ $menu->details }}</p>
                    <td>
                        <button type="button" class="btn btn-red">削除</button>
                    </td>
                </tr>
                <tr class="total">
                    <th colspan="3">合計</th>
                    <td colspan="2">0</td>
                </tr>
            </tbody>
        </table>
     <div class="cart-btn">
          <button type="button" class="btn btn-blue">購入手続きへ</button>
<div>
 <!--<a href="{{ action('cartController@add',['id' => $menu->id]) }}">カートに入れる</a>-->お買い物を続ける？
       </div>
    </div>
 </div>