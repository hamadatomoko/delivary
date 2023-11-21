@extends('layouts.app_admin')
@section('title', '注文状況編集')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>注文状況編集</h2>
                <form action="{{ url('admin/order/confirm')}}" method="POST" class="form-horizontal">
                    @csrf
                   {{-- <input type="hidden" name="_method" value="put">--}}
                    <div class="form-group row">
        
                        <h1 class="col-md-12 text-center">{{ $order->user->name }}</h1>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4" for="title">お届け希望時間</label>
                        <input type="datetime-local" id="appt" name="appt" value="{{ $order->estiimated_delivery_time }}" min="{{$minTime}}" required>
                    </div>
                    <a href="javascript:OnButtonClick();">商品追加</a> 
                    <!--23行目　最初データベースから取ってき値を表示する（$detail->menu_id）。送信ボタンを押してバシデーションエラーでこの画面に戻って来た時にはsseccionに保存してあるdataを使えます。-->
                    <!--画面を最初表示するとき第二引数の値を使う。-->
                    <!--この値が選択肢のmenu_idと同じだったらそれが選択されているようにする。-->
                    <!--"menu_id[]","quantity[]何番目のメニューをいくつ注文したか？POSTで送信する時配列で渡す-->
                    <div class="items-container" id="items-container">
                        
                        @php $i = 0; @endphp
                        @foreach($order->details as $detail)
                            <div class="form-group row item">
                                <select class="form-select" id="menu-id" name="menu_id[]">
                                @foreach($menu as $item)
                                    @php $n = "menu_id." . $i @endphp
                                    <option value="{{ $item->id }}" @if(old($n, $detail->menu_id) == $item->id) selected="selected" @endif>{{ $item->name }}</option>
                                @endforeach
                                </select>
                                @php $q = "quantity." . $i @endphp
                                <input type="number" name="quantity[]" value="{{old($q, $detail->quantity)}}">人前
                                
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="wasabi[]" value="true">ワサビなし
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="large[]" value="true">大盛りなし
                                    </label>
                                </div>
                                <button type="button" onclick="deleteItem(this);">
                                        削除
                                </button>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                        
                    <div class="form-group row">
                        <label class="col-md-4" for="title">住所</label>
                        <label class="col-md-6" for="title"><input type="text" name="address" value="{{ $order->address }}"></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4" for="title">電話番号</label>
                        <label class="col-md-6" for="title"><input type="text" name="tel" value="{{ $order->tel }}"></label>
                    </div>
                    
                    <input type="hidden" name="id" value={{ $order->id }}>
                    <input type="submit" value="確認">
                    @if($order->order_status == 0)
                    
                          
                          <a href="{{ route('admin.order.change', ['id'=>$order->id]) }}">配達完了</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
        
    <script language="javascript" type="text/javascript">
        function OnButtonClick() {
            console.log("onbuttonclic");
            // 孫要素もコピーする必要がある、引数にtrueを持ってくる。
            let clone = document.querySelector(`.item`).cloneNode(true);
            
            console.log(clone);
            document.querySelector(`.items-container`).appendChild(clone);
            
        }
        
        function deleteItem(item) {
            console.log(item.parentElement);
            item.parentElement.remove();
        }
    
    </script>

    
                  
              

 @endsection
 
 