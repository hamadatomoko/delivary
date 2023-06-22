@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>価格</th>
            </tr>
            @foreach($menus as $menu)
            <tr>
                <td><a href="menu/detail?id={{ $menu->id }}">{{ $menu->id }}</a></td>
                <td><a href="menu/detail?id={{ $menu->id }}">{{ $menu->name }}</a></td>
                <td><a href="menu/detail?id={{ $menu->id }}">{{ $menu->price }}</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
