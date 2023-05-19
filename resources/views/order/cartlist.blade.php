@extends('layouts.app')

@section('content')

    <main>

        <div class="container">
            <div class="row">
                <div class="col-12 card border-dark mt-5">
                    <div class="cord-body ml-3 mb-2">
                        <h4 class="mt-4">お届け先</h4>
                        <p class="mb-2" style="padding-left: 20px;">
                            @if(Auth::check())
                                {{$order->address}}
                                {{$order->tel}}
                                
                            @endif
                        </p>
                        <p style="padding-left: 160px;">
                            @if(Auth::check())
                                {{Auth::user()->last_name}}
                                {{Auth::user()->first_name}}
                            @endif
                            様
                        </p>
                    </div>
                    </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <table class="table mt-5 ml-3 border-dark">
                    <thead>
                        <tr class="text-center">
                            <th class="border-bottom border-dark" style="width:13%;">No</th>
                            <th class="border-bottom border-dark" style="width:18%;">商品名</th>
                            <th class="border-bottom border-dark" style="width:15%;">商品カテゴリ</th>
                            <th class="border-bottom border-dark" style="width:15%;">値段</th>
                            <th class="border-bottom border-dark" style="width:15%;">個数</th>
                            <th class="border-bottom border-dark" style="width:15%;">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($cartData as $key => $data)
                                <tr class="text-center">
                                    <th class="align-middle">{{ $key += 1 }}</th>
                                    <td class="align-middle">
                                        {{ $data['product_name'] }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $data['category_name'] }}
                                        </td>
                                    <td class="align-middle">
                                        ¥{{ number_format($data['price']) }} 円
                                    </td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-outline-dark">
                                            {{ $data['session_quantity'] }}
                                        </button>
                                        個
                                    </td>
                                    <td class="align-middle">
                                        ¥{{ number_format($data['session_quantity'] * $data['price']) }}
                                    </td>

                                    <td class="border-0 align-middle">
                                        {!! Form::open(['route' => ['itemRemove', 'method' => 'post', $data['session_products_id']]]) !!}
                                            {{ Form::submit('削除', ['name' => 'delete_products_id', 'class' => 'btn btn-danger']) }}
                                            {{ Form::hidden('product_id', $data['session_products_id']) }}
                                            {{ Form::hidden('product_quantity', $data['session_quantity']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
