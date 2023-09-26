@extends('layouts.app')
@section('title', 'リスト')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
              <form action="{{ route('order.complete') }}" method="post">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">住所</label>
                  {{$address}}
                  
                </div>
                
                <label for="phone">電話番号:</label>
                {{$tel}}
                
                配達日{{$appt}}
                
              
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartData as $cs)
                                <tr>
                                    <th>{{ $cs['product_name'] }}</th>
                                    <td>{{ $cs['price']}}</td>
                                    <td>{{ $cs['quantity'] }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>お醤油{{$syouyu ? "必要" : "不要"}}</p> 
                    <p>税抜き価格：{{ $totalPrice }}</p>
                    <p>税込価格： {{ $tax }}</p>
                </div>
            </div>
        </div>
        <div class="row">
             {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="確定">
        </div>
              </form>
    </div>



@endsection