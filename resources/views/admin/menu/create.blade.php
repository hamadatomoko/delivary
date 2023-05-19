@extends('layouts.app_admin')
@section('title', '商品登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>商品登録</h2>
                <form action="{{ action('Admin\MenuController@create') }}" method="post" enctype="multipart/form-data">


                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">商品名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">商品説明</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="details" rows="10">{{ old('details') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">商品カテゴリ</label>
                        <div class="col-md-10">
                            <select name ="category_id">
                              @foreach( $cate as $c)
                              <option value="{{ $c->id }}" @if(old('category_id') == $c->id) selected="selected" @endif>{{ $c->name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">カスタマイズ</label>
                        <div class="col-md-10">
                            <input type="radio" name=“customization” value=0>無
                            <input type="radio" name="customization" value=1>有
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">値段</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                           
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>    
                    <div class="form-group row">
                        <label class="col-md-2" for="title">所要時間</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="required_time" value="{{ old('required') }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
