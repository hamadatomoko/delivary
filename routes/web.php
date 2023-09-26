<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/', function () {
    return redirect('/home');
});

// 一般ユーザのルーティング
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('menu', 'MenuController@index')->name('menu.index');
    Route::get('menu/detail', 'MenuController@detail')->name('menu.detail');
    // formから遷移してきた場合はpostになる
    Route::post('cart/add', 'CartController@addCart')->name('cart.add');
    Route::post('cart/delete', 'CartController@deleteCart')->name('cart.delete');
    Route::get('cart/index', 'CartController@index')->name('cart.index');
    Route::get('order/information', 'OrderController@information')->name('order.information');
    Route::post('order/confirm', 'OrderController@confirm')->name('order.confirm');
    Route::post('order/complete', 'OrderController@complete')->name('order.complete');
});

// 管理者のルーティング
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    // Route::get('/', function () {
    //     return redirect('/admin/home');
    // });
    
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    Route::get('menu/create', 'Admin\MenuController@add')->name('admin.menu.add');
    Route::post('menu/create', 'Admin\MenuController@create')->name('admin.menu.create');
    Route::get('menu/edit', 'Admin\MenuController@edit')->name('admin.menu.edit');
    Route::post('menu/edit', 'Admin\MenuController@update')->name('admin.menu.update');
    Route::get('menu', 'Admin\MenuController@index')->name('admin.menu');
    Route::get('order', 'Admin\OrderController@index')->name('admin.order');
    Route::get('order/detail/{id}', 'Admin\OrderController@detail')->name('admin.order.detail');
    Route::get('order/change/{id}', 'Admin\OrderController@change_order_status')->name('admin.order.change');
    Route::get('order/edit/{id}', 'Admin\OrderController@edit')->name('admin.order.edit');
    Route::post('order/edit/{id}', 'Admin\OrderController@update')->name('admin.order.update');
    Route::get('user', 'Admin\UserController@index')->name('admin.user');
    Route::get('user/{id}', 'Admin\UserController@detail')->name('admin.user.detail');
});
