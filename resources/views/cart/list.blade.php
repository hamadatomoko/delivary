@extends('layouts.app')
@section('title', 'リスト')
@push('scripts')
<script>
    /** 
     * カートの商品数を変更
     * @param {number} menuId: 商品ID
     * @param {number} quantity: 追加数量
     */
    function addCart(menuId, quantity)
    {
        // form要素を生成
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ url('/cart/add')}}";
        
        // パラメータ設定
        var input = document.createElement("input");
        input.type = 'hidden';
        input.name = 'menuId';
        input.value = menuId;
        form.appendChild(input);
        
        input = document.createElement("input");
        input.type = 'hidden';
        input.name = 'quantity';
        input.value = quantity;
        form.appendChild(input);
        
        input = document.getElementsByName("_token")[0];
        form.appendChild(input);
        // formを送信
        document.body.appendChild(form);
        form.submit();
    }
    
    /** 
     * カートから商品を削除
     */
    function deleteCart(menuId)
    {
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ url('/cart/delete')}}";
        
        // パラメータ設定
        var input = document.createElement("input");
        input.type = 'hidden';
        input.name = 'menuId';
        input.value = menuId;
        form.appendChild(input);
        
        input = document.getElementsByName("_token")[0];
        form.appendChild(input);
        // formを送信
        document.body.appendChild(form);
        form.submit();
        
    }
</script>
@endpush

@section('content')
@csrf
    <div class="container">
        <div class="row">
            <h2>リスト</h2>
        </div>
        <div class="row">
           
            <div class="col-md-8">
                <form action="{{ route('order.confirm') }}" method="post">
                    <div class="form-group row">
                       
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="削除">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                <th width="30%"></th>
                                <th width="30%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartData as $cs)
                                <tr>
                                    <th>{{ $cs['product_name'] }}</th>
                                    <td>{{ $cs['price']}}</td>
                                    <td>{{ $cs['quantity'] }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="addCart({{$cs['menu_id']}}, 1)">+</button>
                                        <button class="btn btn-primary" onclick="addCart({{$cs['menu_id']}}, -1)">-</button>
                                    </td>
                                    <td><button class="ptn ptn-denger"  onclick="deleteCart({{$cs['menu_id']}})">削除</button></td>
                                    
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{ action('OrderController@confirm') }}" method="post" class="form-example">
                        <div>
                          <input type="checkbox" id="syouyu" name="syouyu" checked>
                          <label for="syouyu">お醤油が必要な場合</label>
                          <input type="checkbox" id="hashi" name="hashi" checked>
                          <label for="hashi">箸が必要な場合</label>
                        </div>
                    </form>    
                    {{ $totalPrice }}
                </div>
            </div>
        </div>
        <div class="row">
            <a href="{{ route('order.information') }}" class="btn btn-primary">お会計に進む</a>
        </div>
    </div>
@endsection