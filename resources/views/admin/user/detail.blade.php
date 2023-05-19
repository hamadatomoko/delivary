@extends('layouts.app_admin')
@section('title', '注文一覧')

@section('content')
  <h2>顧客詳細</h2>
<table class="table table-dark">
  <thead>
      <tr>
          <th width="20%">名前</th>
          <th width="20%">住所</th>
          <th width="20%">tel</th>
          <th width="10%">memo</th>
          <th width="10%">email </th>
          
          
      </tr>
  </thead>
  <tbody>
      
         
              <th>{{ $user->name}}</th>
              <td>{{ $user->address}}</td>
              <td>{{ $user->tel}}</td>
              <td>{{ $user->memo}}</td>
              <td>{{ $user->email}}</td>
              
              
             
          
  </tbody>
</table>

@endsection