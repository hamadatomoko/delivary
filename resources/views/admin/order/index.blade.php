@extends('layouts.app_admin')
@section('title', '注文一覧')

@section('content')
  <h2>注文一覧</h2>
<table class="table table-dark">
  <thead>
      <tr>
          <th width="20%">受付日時</th>
          <th width="20%">ユーザー名</th>
          <th width="20%">お届け想定時間</th>
          <th width="20%">注文状況</th>
          <th width="20%">詳細</th>
          
          
      </tr>
  </thead>
  <tbody>
      @foreach($orders as $d)
          <tr>
              <th>{{ $d->ordered_at }}</th>
              <td>{{ $d->user->name }}</td>
              <td>{{ $d->estiimated_delivery_time}}</td>

              <td>
              @if($d->order_status == 0)
                      <p>未配達</p>
               @else($d->order_status == 1)         
                      <p >配達済み</p>
               @endif 
               </td> 

 <td><a href="{{ route('admin.order.detail',['id'=>$d->id]) }}">詳細</a></td>            
          </tr>
      @endforeach
  </tbody>
</table>

@endsection