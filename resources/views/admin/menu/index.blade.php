@extends('layouts.app_admin')
@section('title', '商品一覧')

@section('content')




  <h2>商品一覧</h2>


  
  <a href="/admin/menu/create">新規商品登録</a>
<table class="table table-dark">
  <thead>
      <tr>
          <th width="10%">商品名</th>
          <th width="20%">値段</th>
          <th width="50%">写真</th>
          <th width="10%">操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($data as $d)
      <tr>
          <th>{{ $d->name }}</th>
          <td>{{ $d->price }}</td>
          <td>{{ $d->picture }}</td>
          <td>
            <div>
                <a href="{{ action('Admin\MenuController@edit', ['id' => $d->id]) }}">編集</a>
            </div>
          </td>
      </tr>
  @endforeach
  </tbody>
</table>

@endsection