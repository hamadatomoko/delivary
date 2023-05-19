@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
  <h2>商品一覧</h2>
<table class="table table-sm table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
      @foreach($data as $d)
    <tr>
      <th scope="row">1</th>
      <td>{{$d->name}}</td>
      <td>{{$d->price}}</td>
      <td>
          <img src="{{ asset('storage/image/' . $d->picture) }}">
      </td>
      <td><a href="{{ route('menu.detail', ['id'=>$d->id]) }}">詳細</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection