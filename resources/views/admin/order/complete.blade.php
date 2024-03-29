@extends('layouts.app_admin')
@section('title', '注文状況編集')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>注文状況編集</h2>
                <div class="form-group row">
                    <label class="col-md-4" for="title">名前</label>
                    <label class="col-md-6" for="title">{{ $order_form->user->name }}</label>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="title">お届け希望時間</label>
                    <label class="col-md-6" for="title">{{ $order_form->estiimated_delivery_time }}</label>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="title">注文商品</label>
                    @foreach($order_form->details as $detail )
                    {{$detail->menu->name}}
                    {{$detail->quantity}}
                    @endforeach
                    <label class="col-md-6" for="title">{{ $order_form->orderd_id }}</label>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="title">住所</label>
                    <label class="col-md-6" for="title">{{ $order_form->address }}</label>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="title">電話番号</label>
                    <label class="col-md-6" for="title">{{ $order_form->tel }}</label>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="title">備考</label>
                    <label class="col-md-6" for="title">{{ $order_form->memo}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="title">値段</label>
                    <label class="col-md-6" for="title">{{ $order_form->total_money }}</label>
                </div>
                 @if($order_form->order_status == 0)
                      <a href="/admin/menu/edit">編集</a>
                      <a href="{{ route('admin.order.change',['id'=>$order_form->id]) }}">配達完了</a>
                  @endif
            </div>
        </div>
    </div>
    
                  
              

 @endsection
 