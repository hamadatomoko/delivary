@extends('layouts.app_admin')
@section('title', '注文一覧')

@section('content')
  <h2>顧客管理一覧</h2>
<table class="table table-dark">
  <thead>
      <tr>
          <th width="20%">ID</th>
          <th width="20%">名前</th>
          <th width="20%">メールアドレス</th>
          <th width="10%">tel</th>
          
          
      </tr>
  </thead>
  <tbody>
      @foreach($data as $d)
          <tr>
              <th>{{ $d->ID }}</th>
              <td>{{ $d->name}}</td>
              <td>{{ $d->email}}</td>
              
              <td>{{ $d->tel}}</td>
              
              
 <td><a href="{{ route('admin.user.detail',['id'=>$d->id]) }}">詳細</a></td>            
          </tr>
      @endforeach
  </tbody>
</table>

@endsection