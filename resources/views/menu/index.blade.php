@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
  <h2>商品一覧</h2>
  
<table class="table table-sm table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">商品名</th>
      <th scope="col">価格</th>
      <th scope="col">写真</th>
      <th scope="col">個数</th>
      <th scope="col">サビ抜き</th>
      <th scope="col">大盛り</th>
      <th scope="col">詳細</th>
    </tr>
  </thead>
  <tbody>
      @foreach($data as $d)
    <tr>
      <form action="{{ url('/cart/add')}}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
      <th scope="row">1</th>
      <td>{{$d->name}}</td>
      <td>{{$d->price}}</td>
      <td>
          <img src="{{ asset('storage/image/' . $d->picture) }}" width="10%">
      </td>
      <td>
        <select name='quantity'>
          <option value='1'>1人前</option>
          <option value='2'>2人前</option>
          <option value='3'>3人前</option>
          <option value='4'>4人前</option>
          <option value='5'>5人前</option>
          <option value='6'>6人前</option>
          <option value='7'>7人前</option>
          <option value='8'>8人前</option>
          <option value='9'>9人前</option>
          <option value='10'>10人前</option>
       
        </select> 
      </td>
      <td><input type="checkbox" class="form-check-input" name="wasabi" value="true"></td>
       <input type="hidden" name="menuId" value={{$d->id}}>  
        
      <td><input type="checkbox" class="form-check-input" name="large" value="true"></td>
      <td><a href="{{ route('menu.detail', ['id'=>$d->id]) }}">詳細</a></td>
     <td> <button type="submit">追加</button></td>
 </form>     
    </tr>
    @endforeach
  </tbody>
</table>
<button type="submit">注文</button>

@endsection