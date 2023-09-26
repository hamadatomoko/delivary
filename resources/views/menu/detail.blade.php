@extends('layouts.app')
@section('title', '商品詳細')

@section('content')
  <h2>商品詳細</h2>
<p>{{ $menu->name }}</p>
<p>{{ $menu->price }}</p>
<p>{{ $menu->details }}</p>
<p><img src="{{ asset('storage/image/' . $menu->picture) }}" style="width: 300px"></p>
  <!--データを送るための宛先-->
<form action="{{ url('/cart/add')}}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="wasabi" value="true">ワサビなし
      </label>
    </div>
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
    <input type="hidden" name="menuId" value={{$menu->id}}>
    <button type="submit">
    追加
    </button>
</form>      
    

@endsection